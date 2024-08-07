<!-- Add Course Modal -->
<div class="modal fade" id="addCourseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCourseModal" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('course.add') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addCourseModal">Add Course</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="short_name" class="form-label">Short Name</label>
                            <input type="text" class="form-control" name="short_name" id="short_name">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="full_name" id="full_name">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="college_department" class="form-label">College Department</label>
                            <select class="form-select" id="college_id" name="college_id"></select>
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

<!-- Edit Course Modal -->
<div class="modal fade" id="editCourseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCourseModal" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('course.update') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editCourseModal">Edit College Department</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="short_name" class="form-label">Short Name</label>
                            <input type="text" class="form-control" name="short_name" id="edit_short_name">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="full_name" id="edit_full_name">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="college_department" class="form-label">College Department</label>
                            <select class="form-select" id="edit_college_id" name="college_id"></select>
                        </div>
                            <input type="hidden" class="form-control" name="course_id" id="course_id" value="">
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