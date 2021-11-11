@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                {{ __('Form Tambah Customer') }}
                            </div>
                            <div class="col-6 ">
                                <a href="{{ url('user') }}" class="btn btn-warning float-right">Kembali</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (!$edit)
                        <form method="POST" action="{{ url('user') }}" enctype="multipart/form-data">
                        @else
                        <form method="POST" action="{{ url('user/'.$data->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                        @endif
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputName">Name</label>
                                    <input type="text" class="form-control" id="inputName" placeholder="Name" name="name"
                                    value="{{ $edit ? $data->name : old('name') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Email</label>
                                    <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email"
                                           value="{{ $edit ? $data->email : old('email') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password"
                                    >
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPhone">Role</label>
                                    <select class="form-control" name="roles[]" id="roles">
                                        <option value="" selected hidden>Pilih</option>
                                        @foreach($roles as $role)
                                            @if ($edit)
                                                <option {{ in_array($role->id, $rolesId) ? 'selected' : '' }} value="{{$role->id}}">{{$role->name}}</option>
                                            @else
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 @if ($edit && $data->userOrganization->count() > 0 )
                                @else d-none @endif" id="part_organization">
                                    <label for="inputOrganization">Organization</label>
                                    <select class="form-control" name="organization[]" multiple>
                                        @foreach(\App\Models\Organization::all() as $row)
                                            @if ($edit)
                                                <option {{ in_array($row->id, $organizationId) ? 'selected' : '' }} value="{{$row->id}}">{{$row->name}}</option>
                                            @else
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" >Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script>
        $("#roles").change(function () {
            if ($(this).val() == 1) {
                $("#part_organization").removeClass('d-none')
            } else {
                $("#part_organization").addClass('d-none')
            }
        })
    </script>
@endpush
