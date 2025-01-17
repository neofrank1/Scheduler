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

    $(document).ready(function () {
        let subjectFormContainer = $('#subjectFormContainer');
        let addButton = $('#addButton');
        let removeButton = $('#removeButton');
        let subjectIndex = 1; // Start from 1 since the initial form is already present

        addButton.on('click', function () {
            let newSubjectForm = $('.subject-form').first().clone();
            newSubjectForm.find('select').each(function () {
                $(this).attr('name', $(this).attr('name').replace(/\[0\]/, '[' + subjectIndex + ']'));
                $(this).prop('selectedIndex', 0); // Reset the select element
            });
            newSubjectForm.find('input[type="hidden"]').each(function () {
                $(this).attr('name', $(this).attr('name').replace(/\[0\]/, '[' + subjectIndex + ']'));
            });
            subjectFormContainer.append(newSubjectForm);
            subjectIndex++;
        });

        removeButton.on('click', function () {
            if (subjectFormContainer.children().length > 1) {
                subjectFormContainer.children().last().remove();
                subjectIndex--;
            }
        });
    });

</script>

@endsection