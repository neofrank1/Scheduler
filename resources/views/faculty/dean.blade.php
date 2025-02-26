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
        @elseif(session('error'))
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-check-square"></i>
                    {{ session('error') }}
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
                                <h4 class="card-title mt-2">Dean List</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-primary shadow" id="table-dean">
                            <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>College Department</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="module">

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       $(document).ready(function (){
            $('#table-dean').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ route('dean.home') }}`,
                columns: [
                    { data: 'employee_id', name: 'employee_id' },
                    { data: 'first_name', name: 'first_name' },
                    { data: 'middle_name', name: 'middle_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'college_name', name: 'college_name', searchable: false},
                    {
                        data: null,
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            if (row.status === 0) {
                               /*  <a type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editCourseModal" data-id="${row.id}">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a> */
                                return `
                                    <a type="button" class="btn btn-secondary btn-activate" data-status="1" data-id="${row.id}">
                                        <i class="fa-solid fa-check"></i> Activate
                                    </a>
                                `;
                            } else { 
                                /* <a type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editCourseModal" data-id="${row.id}">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a> */
                                return `
                                    <a type="button" class="btn btn-danger btn-deactivate" data-status="0" data-id="${row.id}">
                                        <i class="fa-solid fa-circle-xmark"></i> Deactivate
                                    </a>`
                                ;
                            } 
                        }
                    }
                ],
                responsive: true
            });

            $('#table-dean').on('click', '.btn-deactivate', function() {
                var id = $(this).data('id');
                var status = $(this).data('status');

                $.ajax({
                    url: '{{ route('dean.status') }}',
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

            $('#table-dean').on('click', '.btn-activate', function() {
                var id = $(this).data('id')
                var status = $(this).data('status');

                $.ajax({
                    url: '{{ route('dean.status') }}',
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
       })

    </script>


@endsection
