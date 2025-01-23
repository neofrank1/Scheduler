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
                                    <th>Subject</th>
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

        const pathParts = window.location.pathname.split('/');
        const id = pathParts[pathParts.length - 1];

        $('#table-schedule').dataTable({
            processing : true,
            serverSide : true,
            ajax: `/schedule/editSchedule/${id}`,
            columns: [
                { data: 'subject', name: 'subject' },
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
                            `;
                        } else { 
                            return `
                                <a type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editSubjectModal" data-id="${row.id}">
                                    <i class="fa-solid fa-pen"></i> Edit
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