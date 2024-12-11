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
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal" id="room_add">
                                <i class="fa-solid fa-plus"></i>
                                Add Subject
                            </button>
                    </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-primary shadow" id="table-room">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Subject Name</th>
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