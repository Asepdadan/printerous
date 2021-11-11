<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\UserOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
Use Alert;

class UserController extends Controller
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
            $result = User::query();
            return DataTables::of($result)
                ->addColumn('role', function($row) {
                    return $row->roles->implode('name', ',');
                })
                ->editColumn('created_at', function($row) {
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('action', function($row) {
                    $html = "";
                    if (Gate::allows('create-user')):
                    $html .= '<a class="btn btn-warning" href="'.url("user/".$row->id.'/edit').'">Edit</a>';
                    endif;

                    if (Gate::allows('create-user')):
                    $html .= '&nbsp;&nbsp;<a class="btn btn-danger" href="#" onclick="hapus('.$row->id.')" data-href="'.url("user/".$row->id).'">Hapus</a>';
                    endif;

                    return $html;
                })
                ->rawColumns(['action', 'logo'])
                ->make(true);
        }
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {;
        $user = Auth::user();
        if (!Gate::allows('create-user')) {
            return abort(404);
        }
        $edit = false;
        $roles = Role::all();
        return view('user.form', compact('edit', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except(['roles']);
            if ($request->has('password')) {
                $data['password'] = Hash::make($data['password']);
            }

            $user = User::create($data);

            if ($request->has('roles')) {
                foreach ($request->roles as $row) {
                    RoleUser::create([
                        'user_id' => $user->id,
                        'role_id' => $row
                    ]);
                }
            }

            if ($request->has('organization')) {
                foreach ($request->organization as $row) {
                    UserOrganization::create([
                        'user_id' => $user->id,
                        'organization_id' => $row
                    ]);
                }
            }

            DB::commit();
            alert()->success('Berhasil','Simpan data berhasil');
            return redirect('user');
        } catch (\Throwable $throwable) {
            DB::rollBack();
            alert()->success('Berhasil','Simpan data gagal '.$throwable->getMessage());
            return redirect('user');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = true;
        $roles = Role::all();
        $data = User::with('roles')->find($id);
        $rolesId = $data->roles->pluck('id')->toArray();
        $organizationId = $data->userOrganization->pluck('organization_id')->toArray();

        return view('user.form', compact('edit', 'roles', 'rolesId', 'data','organizationId'));
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
        DB::beginTransaction();
        try {
            $data = $request->except(['roles']);

            if ($request->has('password')) {
                $data['password'] = Hash::make($data['password']);
            }

            $user = User::find($id)->update($data);

            if ($request->has('roles')) {
                RoleUser::where('user_id', $id)->delete();
                foreach ($request->roles as $row) {
                    RoleUser::create([
                        'user_id' => $id,
                        'role_id' => $row
                    ]);
                }
            }

            if ($request->has('organization')) {
                UserOrganization::where('user_id', $id)->delete();
                foreach ($request->organization as $row) {
                    UserOrganization::create([
                        'user_id' => $id,
                        'organization_id' => $row
                    ]);
                }
            }

            DB::commit();
            alert()->success('Berhasil','Simpan data berhasil');
            return redirect('user');
        } catch (\Throwable $throwable) {
            DB::rollBack();
            alert()->success('Berhasil','Simpan data gagal '.$throwable->getMessage());
            return redirect()->back();
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
        DB::beginTransaction();
        try {
            RoleUser::where('user_id', $id)->delete();
            $user = User::find($id)->delete();
            DB::commit();
            return response()->json([
               'error' => 0,
               'message' => 'berhasil'
            ]);
        } catch (\Throwable $throwable) {
            DB::rollBack();
            return response()->json([
                'error' => 1,
                'message' => 'gagal '.$throwable->getMessage()
            ]);
        }
    }
}
