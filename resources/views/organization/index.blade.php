@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                {{ __('Customer') }}
                            </div>
                            <div class="col-6 ">
                                @can('create-organization')
                                <a href="{{url('organization/create')}}" class="btn btn-primary float-right">Tambah</a>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="table-customer" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th>Logo</th>
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
            table = $('#table-customer').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('organization') !!}',
                columns: [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "searchable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    { data: 'name', name: 'name' },
                    { data: 'phone', name: 'phone' },
                    { data: 'email', name: 'email' },
                    { data: 'website', name: 'website' },
                    { data: 'logo', name: 'logo' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' }
                ]
            });
        });

        $('#table-customer tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var tableId = 'persons-'+row.data().id;

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                console.log("test")
                row.child(`
                    <table class="table details-table" id="${tableId}">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Avatar</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                `).show();
                initTable(tableId, row.data());
                tr.addClass('shown');
                tr.next().find('td').addClass('no-padding bg-gray');
            }
        });

        function initTable(tableId, data) {
            $('#' + tableId).DataTable({
                processing: true,
                serverSide: true,
                ajax: data.details_url,
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'phone', name: 'phone' },
                    { data: 'email', name: 'email' },
                    { data: 'avatar', name: 'avatar' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' }
                ]
            })
        }

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
                        url : '{{ url("organization") }}/'+Id,
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

        function hapusPerson(organizationId, person)
        {
            Swal.fire({
                icon : 'question',
                title: 'Apakah anda yakin?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    return $.ajax({
                        url : '{{ url("organization") }}/'+organizationId+'/person/'+person,
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
