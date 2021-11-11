@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                {{ __('Form Tambah Pereson') }}
                            </div>
                            <div class="col-6 ">
                                <a href="{{ url('organization') }}" class="btn btn-warning float-right">Kembali</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (!$edit)
                        <form method="POST" action="{{ url('organization/'.$organizationId.'/person') }}" enctype="multipart/form-data">
                        @else
                        <form method="POST" action="{{ url('organization/'.$organizationId.'/person/'.$data->id) }}" enctype="multipart/form-data">
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
                                    <label for="inputPhone">Phone</label>
                                    <input type="text" class="form-control" id="inputPhone" placeholder="Phone" name="phone"
                                           value="{{ $edit ? $data->phone : old('phone') }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputAvatar">Avatar</label>
                                    <input type="file" class="form-control" accept="image/jpeg, image/jpg, image/png" id="inputAvatar" placeholder="avatar" name="avatar">
                                    @if ($edit)
                                    @if (\Illuminate\Support\Facades\Storage::disk('public')->exists($data->avatar))
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($data->avatar) }}" class="img-thumbnail" width="100" height="100">
                                    @endif
                                    @endif
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
