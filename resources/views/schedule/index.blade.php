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
                                    <th>Section</th>
                                    <th>Course</th>
                                    <th>Subject</th>
                                    <th>Professor</th>
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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

        $('#table-schedule').dataTable({
            processing : true,
            serverSide : true,
            ajax: {
                url: `{{ route('schedule.home') }}`,
                dataSrc: function (json) {
                    console.log(json);
                    return json.data;
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'section', name: 'section' },
                { data: 'course', name: 'course' },
                { data: 'subject', name: 'subject' },
                { data: 'professor', name: 'professor' },
                { data: 'semester', name: 'semseter' },
                { data: 'school_yr', name: 'school_yr', searchable: false, orderable: false},
                { 
                    data: null, 
                    name: 'actions', 
                    searchable: false,
                    render: function(data, type, row) {
                        if (row.status === 0) {
                            return `
                            <div class="dropdown">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-list"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item" href="/schedule/editSchedule2/${row.id}">
                                                <i class="fa-solid fa-pen"></i> Edit Teacher/Room/Section
                                            </a>                                   
                                        </li>
                                        <li><a class="dropdown-item" href="/schedule/editSchedule/${row.id}">
                                                <i class="fa-solid fa-pen"></i> Edit Subject Time Slot
                                            </a>        
                                        </li>
                                        <li><a class="dropdown-item" data-status="1" data-id="${row.id}">
                                                <i class="fa-solid fa-circle-xmark"></i> Activate
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            `;
                        } else { 
                            return `
                                <div class="dropdown">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-list"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item" href="/schedule/editSchedule2/${row.id}">
                                                <i class="fa-solid fa-pen"></i> Edit Teacher/Room/Section
                                            </a>                                   
                                        </li>
                                        <li><a class="dropdown-item" href="/schedule/editSchedule/${row.id}">
                                                <i class="fa-solid fa-pen"></i> Edit Subject Time Slot
                                            </a>        
                                        </li>
                                        <li><a class="dropdown-item" data-status="0" data-id="${row.id}">
                                                <i class="fa-solid fa-circle-xmark"></i> Deactivate
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            `;
                        }
                    }
                }
            ],
            responsive: true
        });

        $('#table-schedule tbody').on('click', 'a.dropdown-item', function () {
            let status = $(this).data('status');
            console.log(status);
            let id = $(this).data('id');
            let url = '{{ route('schedule.updateStatus') }}';
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function (response) {
                    console.log(response);
                    $('#table-schedule').DataTable().ajax.reload();
                }
            });
        });
    });

</script>

@endsection