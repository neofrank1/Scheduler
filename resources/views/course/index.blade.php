@extends('layouts.app')
@section('content')
    <div class="container">
       <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row mt-2">
                            <div class="col-6">
                                <h4 class="card-title">Course List</h4>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <i class="fa-solid fa-plus"></i>
                                    Add Course
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                       <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered table-primary shadow" id="table-course">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Short Name</th>
                                            <th>Full Name</th>
                                            <th>Department</th>
                                            <th>Action</th>
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

    <script type="module">
        $(document).ready(function () {
            $('#table-course').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ route('course.home') }}`,
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'short_name', name: 'short_name' },
                    { data: 'full_name', name: 'full_name' },
                    { data: 'college_name', name: 'college_name', searchable: false},
                    {
                        data: null,
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            /* if (row.status === 0) {
                                return `
                                    <a href="#" type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="${row.id}">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <a href="#" type="button" class="btn btn-secondary btn-activate" data-status="1" data-id="${row.id}">
                                        <i class="fa-solid fa-check"></i> Activate
                                    </a>
                                `;
                            } else { */
                                return `
                                    <a href="#" type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="${row.id}">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>`
                                   /*  <a href="#" type="button" class="btn btn-danger btn-deactivate" data-status="0" data-id="${row.id}">
                                        <i class="fa-solid fa-circle-xmark"></i> Deactivate
                                    </a> */
                                ;
                          /*   } */
                        }
                    }
                ],
                responsive: true
            });
        });
    </script>
@endsection