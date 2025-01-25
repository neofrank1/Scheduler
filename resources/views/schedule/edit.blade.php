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
@extends('schedule.modal')
<script type="module">

    $(document).ready(function () {

        const pathParts = window.location.pathname.split('/');
        const id = pathParts[pathParts.length - 1];

        $('#table-schedule').dataTable({
            processing : true,
            serverSide : true,
            paging: false,
            searching: false,
            info: false,
            ajax: `/schedule/editSchedule/${id}`,
            columns: [
                    { data: 'subject_name', name: 'subject_name' },
                    { 
                        data: null, 
                        name: 'actions', 
                        searchable: false,
                        render: function(data, type, row) {
                        if (row.status === 0) {
                            return `
                            <a type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editScheduleModal" data-id="${row.id}">
                                <i class="fa-solid fa-pen"></i> Edit
                            </a>
                            `;
                        } else { 
                            return `
                            <a type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editScheduleModal" data-id="${row.id}">
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