@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                {{ __('User') }}
                            </div>
                            <div class="col-6 ">
                                @can('create-user')
                                <a href="{{url('user/create')}}" class="btn btn-primary float-right">Tambah</a>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="table-user" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/datatable.bootstrap4.min.css') }}">
    <style>
        td.details-control {
            background: url('{{ asset('img/plus.png') }}') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('{{ asset('img/minus.png') }}') no-repeat center center;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/datatables.bootstrap4.min.js') }}"></script>
    <script>
        var table = null
        $(function() {
            table = $('#table-user').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('user') !!}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'role', name: 'role' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' }
                ]
            });
        });

        function hapus(Id)
        {
            Swal.fire({
                icon : 'question',
                title: 'Apakah anda yakin?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    return $.ajax({
                        url : '{{ url("user") }}/'+Id,
                        type : "POST",
                        dataType : "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data : {
                            _method : "DELETE"
                        },
                        success : function (response) {
                            return response
                        }
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.value.error == 0) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus',
                            text: 'Berhasil hapus data!',
                        }).then((result) => {
                            table.ajax.reload()
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terhapus',
                            text: 'Gagal hapus data!',
                        })
                    }
                }
            })
        }

    </script>
@endpush
