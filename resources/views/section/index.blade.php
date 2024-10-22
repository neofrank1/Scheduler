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
        <div class="card shadow">
            <div class="card-header">
                <div class="row mt-2">
                    <div class="col-6">
                        <h4 class="card-title mt-2">Section List</h4>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSectionModal" id="section_add">
                            <i class="fa-solid fa-plus"></i>
                            Add Section
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-primary shadow" id="table-section">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Year Level</th>
                            <th>Program</th>
                            <th>College Department</th>
                            <th>College Course</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@extends('section.modal')

<script type="module">
    $(document).ready(function() {
        $('#table-section').dataTable({
            processing : true,
            serverSide : true,
            ajax: `{{ route('section.home') }}`,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'year_lvl', name: 'year_lvl' },
                { data: 'program', name: 'program', searchable: false, orderable: false},
                { data: 'college_name', name: 'college_name' },
                { data: 'course_name', name: 'course_name' },
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
    });
</script>
@endsection