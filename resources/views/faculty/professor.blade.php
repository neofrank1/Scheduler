@extends('layouts.app')
@section('content')
    @if(session('success'))
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-square"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row mt-2">
                            <div class="col-6">
                                <h4 class="card-title mt-2">Professor List</h4>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProfessorModal" id="professor_add">
                                    <i class="fa-solid fa-plus"></i>
                                    Add Professor
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-primary shadow" id="table-professor">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Employee ID</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Address</th>
                                    <th>Mobile No.</th>
                                    <th>Education</th>
                                    <th>Ranking</th>
                                    <th>College</th>
                                    <th>Course</th>
                                    <th>Maximmum Hours</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@extends('faculty.modal')

<script type="module">

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#table-professor').DataTable({
            processing : true,
            serverSide : true,
            ajax: `{{ route('professor.home') }}`,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'employee_id', name: 'employee_id' },
                { data: 'first_name', name: 'first_name' },
                { data: 'middle_name', name: 'middle_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'address', name: 'address' },
                { data: 'mobile_no', name: 'mobile_no' },
                {
                    data: 'education_id',
                    name: 'education_id',
                    render: function(data, type, row) {
                        switch (data) {
                            case 1:
                                return 'Associate Graduate';
                            case 2:
                                return "Bachelor's Degree";
                            case 3:
                                return "Master's Degree";
                            case 4:
                                return "Doctorate Degree";
                            default:
                                return 'Unknown';
                        }
                    }
                },
                { data: 'ranking_title', name: 'ranking_title' },
                { data: 'college_name', name: 'college_name' },
                { data: 'course_name', name: 'course_name' },
                { data: 'maximum_hours', name: 'maximum_hours', searchable: false, orderable: false},
                { 
                    data: null, 
                    name: 'actions', 
                    searchable: false,
                    render: function(data, type, row) {
                        if (row.status === 0) {
                            return `
                                <a type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editProfessorModal" data-id="${row.id}">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <a type="button" class="btn btn-secondary btn-activate" data-status="1" data-id="${row.id}">
                                    <i class="fa-solid fa-check"></i> Activate
                                </a>
                            `;
                        } else { 
                            return `
                                <a type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editProfessorModal" data-id="${row.id}">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <a type="button" class="btn btn-danger btn-deactivate" data-status="0" data-id="${row.id}">
                                    <i class="fa-solid fa-circle-xmark"></i> Deactivate
                                </a>
                            `;
                        } 
                    }
                }
            ],
            responsive: true
        });

        // Edit
        $('#table-professor').on('click', '.btn-edit', function() {
                var id = $(this).data('id');

            $.ajax({
                url: '/professor/getProfessor/' + id,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    $('#edit_employee_id').val(response.employee_id);
                    $('#edit_first_name').val(response.first_name);
                    $('#edit_middle_name').val(response.middle_name);
                    $('#edit_last_name').val(response.last_name);
                    $('#edit_mobile_no').val(response.mobile_no);
                    $('#edit_address').val(response.address);
                    $('#edit_maximum_hours').val(response.maximum_hours);
                    if ($('#edit_education_id option[value="' + response.education_id + '"]').length === 1) {
                        $('#edit_education_id').val(response.education_id); 
                    }
                    if ($('#edit_ranking_id option[value="' + response.ranking_id + '"]').length === 1) {
                        $('#edit_ranking_id').val(response.ranking_id);
                    }
                    if ($('#edit_employee_status option[value="' + response.employee_status + '"]').length === 1) {
                        $('#edit_employee_status').val(response.employee_status);
                    }
                }
            });
        });

        // Status
        $('#table-professor').on('click', '.btn-deactivate', function() {
                var id = $(this).data('id');
                var status = $(this).data('status');

                $.ajax({
                    url: '{{ route('professor.status') }}',
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

            $('#table-professor').on('click', '.btn-activate', function() {
                var id = $(this).data('id')
                var status = $(this).data('status');

                $.ajax({
                    url: '{{ route('professor.status') }}',
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
