<!-- Add Professor Modal -->
<div class="modal fade" id="addProfessorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addProfessorModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('course.add') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addProfessorModal">Add Professor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h5 class="fw-bold">Personal Info:</h5>
                        <div class="col-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name">
                        </div>
                        <div class="col-6">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="middle_name" id="middle_name">
                        </div>
                        <div class="col-6 mt-2">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name">
                        </div>
                        <div class="col-6 mt-2">
                            <label for="mobile" class="form-label">Mobile Number</label>
                            <input class="form-control" name="mobile_no" id="mobile_no" type="tel" inputmode="numeric" maxlength="11" placeholder="09xxxxxxxxx">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                       {{--  <div class="col-12 mt-2">
                            <label for="college_department" class="form-label">College Department</label>
                            <select class="form-select" id="college_id" name="college_id"></select>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-6 mt-2">
                            <label for="education" class="form-label">Education</label>
                            <input type="text" class="form-control" name="education" id="education">
                        </div>
                        <div class="col-6 mt-2">
                            <label for="ranking" class="form-label">Ranking</label>
                            <input class="form-control" name="ranking" id="ranking" type="tel">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-2">
                            <label for="college" class="form-label">College Department</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                        <div class="col-6 mt-2">
                            <label for="course" class="form-label">Course</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-2">
                            <label for="max_hours" class="form-label">Maximum Hours</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                        <div class="col-6 mt-2">
                            <label for="course" class="form-label">Status</label>
                            <input type="text" class="form-control" name="address" id="address">
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