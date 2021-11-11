@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                {{ __('Detail Customer') }}
                            </div>
                            <div class="col-6 ">
                                <a href="{{ url('organization') }}" class="btn btn-warning float-right">Kembali</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (!$edit)
                        <form method="POST" action="{{ url('organization') }}" enctype="multipart/form-data">
                        @else
                        <form method="POST" action="{{ url('organization/'.$data->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                        @endif
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputName">Name</label>
                                    <input type="text" class="form-control" id="inputName" placeholder="Name" name="name"
                                    value="{{ $edit ? $data->name : old('name') }}" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Email</label>
                                    <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email"
                                           value="{{ $edit ? $data->email : old('email') }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPhone">Phone</label>
                                    <input type="text" class="form-control" id="inputPhone" placeholder="Phone" name="phone"
                                           value="{{ $edit ? $data->phone : old('phone') }}" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputWebsite">Website</label>
                                    <input type="text" class="form-control" id="inputWebsite" placeholder="Website" name="website"
                                           value="{{ $edit ? $data->website : old('website') }}" disabled>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputLogo">Logo</label>
                                    <input type="file" class="form-control" accept="image/jpeg, image/jpg, image/png" id="inputLogo" placeholder="Logo" name="logo" disabled>
                                    @if ($edit)
                                    @if (\Illuminate\Support\Facades\Storage::disk('public')->exists($data->logo))
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($data->logo) }}" class="img-thumbnail" width="100" height="100">
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
