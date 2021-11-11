<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Person;
use App\Models\UserOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;
Use Alert;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();

            $organizaton = Organization::query();
            $userOrganization = $user->userOrganization->pluck('organization_id')->toArray();

            return DataTables::of($organizaton)
                ->editColumn('created_at', function($organization) {
                    return $organization->created_at->format('Y-m-d H:i:s');
                })
                ->editColumn('logo', function($organization) {
                    return '<img width="50" height="50" src="'.Storage::disk('public')->url($organization->logo).'"/>';
                })
                ->addColumn('details_url', function($organization) {
                    return url('organization/details-person/' . $organization->id);
                })
                ->addColumn('action', function($organization) use ($userOrganization){
                    $html = "";

                    $html .= '<a class="btn btn-info" href="'.url("organization/".$organization->id.'').'">Detail</a>';

                    if (in_array($organization->id, $userOrganization)):
                        if (Gate::allows('create-organization')) {
                            $html .= '&nbsp;&nbsp;<a class="btn btn-warning" href="'.url("organization/".$organization->id.'/edit').'">Edit</a>';
                        }

                        if (Gate::allows('create-organization')) {
                            $html .= '&nbsp;&nbsp;<a class="btn btn-danger" href="#" onclick="hapus(' . $organization->id . ')" data-href="' . url("organizatio/" . $organization->id) . '">Hapus</a>';
                        }

                        if (Gate::allows('create-person')) {
                            $html .= '&nbsp;&nbsp;<a class="btn btn-primary" href="' . url('organization/' . $organization->id . '/create') . '">Tambah Person</a>';
                        }
                    endif;

                    return $html;
                })
                ->rawColumns(['action', 'logo'])
                ->make(true);
        }
        return view('organization.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('create-organization')) {
            return abort(404);
        }

        $edit = false;
        return view('organization.form', compact('edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            if ($request->has('logo')) {
                $extension = $request->file('logo')->getClientOriginalExtension();
                $fileName = Uuid::uuid4().".".$extension;
                $data['logo'] = Storage::disk('public')->putFileAs('',$request->logo, $fileName);
            }

            $organization = Organization::create($data);
            UserOrganization::create([
                'user_id' => Auth::user()->id,
                'organization_id' => $organization->id
            ]);

            alert()->success('Berhasil','Simpan data berhasil');
            return redirect('organization')->with(['message', 'Berhasil']);
        } catch (\Throwable $throwable) {
            alert()->success('Berhasil','Simpan data gagal '.$throwable->getMessage());
            return redirect('organization')->with(['message', 'Gagal '.$throwable->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edit = true;
        $data = Organization::find($id);
        return view('organization.detail', compact('data', 'edit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('Edit Organization')) {
            abort(404);
        }

        $edit = true;
        $data = Organization::find($id);
        return view('organization.form', compact('edit', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            if ($request->has('logo')) {
                $extension = $request->file('logo')->getClientOriginalExtension();
                $fileName = Uuid::uuid4().".".$extension;
                $data['logo'] = Storage::disk('public')->putFileAs('',$request->logo, $fileName);
            }
            Organization::find($id)
                ->update($data);

            return redirect('organization')->with(['message', 'Berhasil']);
        } catch (\Throwable $throwable) {
            return redirect('organization')->with(['message', 'Gagal '.$throwable->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('Hapus Organization')) {
            return response()->json([
                'error' => 1,
                'message' => 'Error tidak punya akses'
            ]);
        }

        DB::beginTransaction();
        try {
            Person::where('organization_id', $id)->delete();
            Organization::find($id)
                ->delete();
            UserOrganization::where('organization_id', $id)->delete();

            DB::commit();

            return response()->json([
                'error' => 0,
                'message' => 'Berhasil'
            ]);
        } catch (\Throwable $throwable) {
            DB::rollBack();

            return response()->json([
                'error' => 1,
                'message' => 'Error '.$throwable->getMessage()
            ]);
        }
    }

    public function detailPerson($id)
    {
        $result = Person::where('organization_id', $id);

        return DataTables::of($result)
            ->editColumn('created_at', function($result) {
                return $result->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('avatar', function($result) {
                return '<img width="50" height="50" src="'.Storage::disk('public')->url($result->avatar).'"/>';
            })
            ->addColumn('action', function($result) {
                $html = "";
                if (Gate::allows('create-person')) :
                $html .= '<a class="btn btn-warning" href="'.url("organization/".$result->organization_id.'/person/'.$result->id.'/edit').'">Edit</a>';
                $html .= '&nbsp;&nbsp;<a class="btn btn-danger" href="#" onclick="hapusPerson('.$result->organization_id.','. $result->id.')" data-href="'.url("organization/".$result->organization_id).'">Hapus</a>';
                endif;
                return $html;
            })
            ->rawColumns(['action', 'avatar'])
            ->make(true);
    }

    public function personCreate(Request $request, $organizationId)
    {
        if (!Gate::allows('create-person')) {
            return abort(404);
        }

        $edit = false;
        return view('person.form', compact('edit','organizationId'));
    }

    public function personEdit(Request $request, $organizationId, $id)
    {
        if (!Gate::allows('create-person')) {
            return abort(404);
        }
        $edit = true;
        $data = Person::find($id);
        return view('person.form',compact('edit','data', 'organizationId'));
    }

    public function personStore(Request $request, $organizationId)
    {
        try {
            $data = $request->all();
            $data['organization_id'] = $organizationId;
            if ($request->has('avatar')) {
                $extension = $request->file('avatar')->getClientOriginalExtension();
                $fileName = Uuid::uuid4().".".$extension;
                $data['avatar'] = Storage::disk('public')->putFileAs('',$request->avatar, $fileName);
            }

            Person::create($data);

            return redirect('organization')->with(['message', 'Berhasil']);
        } catch (\Throwable $throwable) {
            dd($throwable->getMessage());
            return redirect('organization')->with(['message', 'Gagal '.$throwable->getMessage()]);
        }
    }

    public function personUpdate(Request $request, $organizationId, $id)
    {
        try {
            $data = $request->all();
            $data['organization_id'] = $organizationId;
            if ($request->has('avatar')) {
                $extension = $request->file('avatar')->getClientOriginalExtension();
                $fileName = Uuid::uuid4().".".$extension;
                $data['avatar'] = Storage::disk('public')->putFileAs('',$request->avatar, $fileName);
            }

            Person::find($id)->update($data);

            return redirect('organization')->with(['message', 'Berhasil']);
        } catch (\Throwable $throwable) {
            dd($throwable->getMessage());
            return redirect('organization')->with(['message', 'Gagal '.$throwable->getMessage()]);
        }
    }

    public function personDestroy(Request $request, $organizationId, $person)
    {
        if (!Gate::allows('Edit Person')) {
            return response()->json([
                'error' => 1,
                'message' => 'Error tidak punya akses'
            ]);
        }

        try {
            Person::find($person)
                ->delete();

            return response()->json([
                'error' => 0,
                'message' => 'Berhasil'
            ]);
        } catch (\Throwable $throwable) {
            return response()->json([
                'error' => 1,
                'message' => 'Error '.$throwable->getMessage()
            ]);
        }
    }
}
