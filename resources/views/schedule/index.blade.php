@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row mt-2">
                            <div class="col-6">
                                <h4 class="card-title mt-2">Schedule List</h4>
                            </div>
                            <div class="col-6 text-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addScheduleModal" id="room_add">
                                <i class="fa-solid fa-plus"></i>
                                Add Schedule
                            </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-primary shadow" id="table-schedule">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Professor</th>
                                    <th>Course</th>
                                    <th>Semester</th>
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
@extends('schedule.modal')

<script type="module">

    $(document).ready(function() {
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

       // Remove all added forms when the close button is clicked
        $("#clearButton").on("click", function () {
            // Remove all subject forms except the first one
            $(".subject-form:not(:first)").remove();

            // Optionally clear the first form's input values
            $(".subject-form:first").find("input").val("");
        });
    });

</script>

@endsection