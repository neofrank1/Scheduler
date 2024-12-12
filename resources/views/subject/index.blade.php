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
                                <h4 class="card-title mt-2">Subject List</h4>
                            </div>
                            <div class="col-6 text-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubjectModal" id="room_add">
                                <i class="fa-solid fa-plus"></i>
                                Add Subject
                            </button>
                    </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-primary shadow" id="table-subject">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Subject Code</th>
                                    <th>Subject Description</th>
                                    <th>Subject Prerequisite</th>
                                    <th>Subject Type</th>
                                    <th>Subject Lab Hours</th>
                                    <th>Subject Lec Hours</th>
                                    <th>Semester</th>
                                    <th>Year Level</th>
                                    <th>S.Y</th>
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
@extends('subject.modal')

<script type="module">
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#table-subject').dataTable({
            processing : true,
            serverSide : true,
            ajax: `{{ route('subject.home') }}`,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'subj_code', name: 'subj_code' },
                { data: 'subj_desc', name: 'subj_desc' },
                { data: 'subj_prereq', name: 'subj_prereq', searchable: false, orderable: false},
                { data: 'subj_type', name: 'subj_type' },
                { data: 'subj_lab_hours', name: 'subj_lab_hours' },
                { data: 'subj_lec_hours', name: 'subj_lec_hours' },
                { data: 'semester', name: 'semester' },
                { data: 'year_level', name: 'year_level' },
                { data: 'school_year', name: 'school_year' },
                { 
                    data: null, 
                    name: 'actions', 
                    searchable: false,
                    render: function(data, type, row) {
                        if (row.status === 0) {
                            return `
                                <a type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editSubjectModal" data-id="${row.id}">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <a type="button" class="btn btn-secondary btn-activate" data-status="1" data-id="${row.id}">
                                    <i class="fa-solid fa-check"></i> Activate
                                </a>
                            `;
                        } else { 
                            return `
                                <a type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editSubjectModal" data-id="${row.id}">
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

        // Add button click handler
        $("#addButton").on("click", function () {
            // Clone the first subject-form
            let newForm = $(".subject-form:first").clone();

            // Clear input values in the cloned form
            newForm.find("input").val("");

            // Append the cloned form to the container
            $("#subjectFormContainer").append(newForm);
        });

        // Remove button click handler
        $("#removeButton").on("click", function () {
            // Get all the forms
            let forms = $(".subject-form");

            // Ensure at least one form remains
            if (forms.length > 1) {
                forms.last().remove();
            }
        });
    });
</script>

@endsection