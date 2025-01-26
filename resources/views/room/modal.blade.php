<!-- Add Room Modal -->
<div class="modal fade" id="addRoomModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addRoomModal" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('room.add') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addRoomModal">Add Room</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="name" class="form-label">Building Name</label>
                            <input type="text" class="form-control" name="building_name" id="name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="name" class="form-label">Floor Number</label>
                            <input type="number" class="form-control" name="floor_number" id="name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="name" class="form-label">Room Number</label>
                            <input type="number" class="form-control" name="room_number" id="name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="sumbit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Room Modal -->
<div class="modal fade" id="editRoomModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editRoomModal" aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{ route('room.update') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editRoomModal">Edit Room</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="name" class="form-label">Building Name</label>
                            <input type="text" class="form-control" name="building_name" id="edit_building_name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="name" class="form-label">Floor Number</label>
                            <input type="number" class="form-control" name="floor_number" id="edit_floor_number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="name" class="form-label">Room Number</label>
                            <input type="number" class="form-control" name="room_number" id="edit_room_number">
                            <input type="hidden" name="room_id" id="edit_room_id">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="sumbit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>