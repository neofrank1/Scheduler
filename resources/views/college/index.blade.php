@extends('layouts.app')

@section('content')
    <div class="container">
       @if(session('success'))
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-square"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
       <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row mt-2">
                            <div class="col-6">
                                <h4 class="card-title">College Department List</h4>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <i class="fa-solid fa-plus"></i>
                                    Add Department
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered table-primary shadow-sm" id="table">
                                    <thead>
                                        <tr>
                                            <td>No.</td>
                                            <td>Short Name</td>
                                            <td>Full Name</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
@extends('college.modal');

    <script type="module">
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#table').DataTable({
                /* dom: '<"dt-buttons"Bf><"clear">lirtp',
                buttons: [
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-copy"></i> Copy',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fa fa-file-csv"></i> CSV',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel"></i> Excel',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf"></i> PDF',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> Print',
                        className: 'btn btn-primary mb'
                    }
                ], */
                processing: true,
                serverSide: true,
                ajax: `{{ route('college.home') }}`,
                dataSrc: function(json) {
                    console.log(json);  // Log the response data to the console
                    return json.data;
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'short_name', name: 'short_name' },
                    { data: 'full_name', name: 'full_name' },
                    {
                        data: null,
                        name: 'actions',
                        render: function(data, type, row) {
                            if (row.status === 0) {
                                return `
                                    <a href="#" type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="${row.id}">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <a href="#" type="button" class="btn btn-secondary btn-activate" data-status="1" data-id="${row.id}">
                                        <i class="fa-solid fa-check"></i> Activate
                                    </a>
                                `;
                            } else {
                                return `
                                    <a href="#" type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="${row.id}">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <a href="#" type="button" class="btn btn-danger btn-deactivate" data-status="0" data-id="${row.id}">
                                        <i class="fa-solid fa-circle-xmark"></i> Deactivate
                                    </a>
                                `;
                            }
                        },
                    }
                ],
                
                responsive: true
            });

            $('#table').on('click', '.btn-edit', function() {
                var id = $(this).data('id');

                $.ajax({
                    url: '/college/getCollege/' + id,
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        $('#edit_short_name').val(response.short_name);
                        $('#edit_full_name').val(response.full_name);
                        $('#college_id').val(id);
                    }
                });
            });

            $('#table').on('click', '.btn-deactivate', function() {
                var id = $(this).data('id');
                var status = $(this).data('status');

                $.ajax({
                    url: '{{ route('college.status') }}',
                    type: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            window.location.reload();
                        } else {
                            alert('Failed to update status');
                        }
                    }
                });
            });

            $('#table').on('click', '.btn-activate', function() {
                var id = $(this).data('id')
                var status = $(this).data('status');

                $.ajax({
                    url: '{{ route('college.status') }}',
                    type: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            window.location.reload();
                        } else {
                            alert('Failed to update status');
                        }
                    }
                });
            });
        });
    </script>

@endsection