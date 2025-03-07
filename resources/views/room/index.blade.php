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
                                <h4 class="card-title mt-2">Room List</h4>
                            </div>
                            <div class="col-6 text-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal" id="room_add">
                                <i class="fa-solid fa-plus"></i>
                                Add Room
                            </button>
                    </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-primary shadow" id="table-room">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Building Name</th>
                                    <th>Floor Number</th>
                                    <th>Room Number</th>
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
@extends('room.modal')
    <script type="module">
        $(document).ready(function (){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#table-room').dataTable({
                processing : true,
            serverSide : true,
            ajax: `{{ route('room.home') }}`,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'building_name', name: 'building_name'},
                { data: 'floor_number', name: 'floor_number'},
                { data: 'room_number', name: 'room_number'},
                { 
                    data: null, 
                    name: 'actions', 
                    searchable: false,
                    render: function(data, type, row) {
                        if (row.status === 0) {
                            return `
                                <a type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editRoomModal" data-id="${row.id}">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                            `;
                        } else { 
                            return `
                                <a type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editRoomModal" data-id="${row.id}">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                            `;
                        } 
                    }
                }
            ],
            responsive: true
            });

            $('#addRoomModal').on('submit', 'form', function(event) {
                var floorNumber = $(this).find('input[name="floor_number"]').val().trim();
                var roomNumber = $(this).find('input[name="room_number"]').val().trim();

                if (floorNumber == 0 || roomNumber == 0) {
                    event.preventDefault();
                    alert('Floor number and room number cannot be zero.');
                }
            });

            $('#editRoomModal').on('submit', 'form', function(event) {
                var floorNumber = $(this).find('input[name="floor_number"]').val().trim();
                var roomNumber = $(this).find('input[name="room_number"]').val().trim();

                if (floorNumber == 0 || roomNumber == 0) {
                    event.preventDefault();
                    alert('Floor number and room number cannot be zero.');
                }
            });
        });

        $('#table-room').on('click','.btn-edit', function(){ 
            var id = $(this).data('id');
            console.log(id);

            $.ajax({
                url: '/room/getRoom/' + id,
                method: 'GET',
                success: function(response) {
                    $('#edit_building_name').val(response.building_name);
                    $('#edit_floor_number').val(response.floor_number);
                    $('#edit_room_number').val(response.room_number);
                    $('#edit_room_id').val(id);
                }
            });
        });


    </script>
@endsection