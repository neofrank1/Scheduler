<!-- Add Section Modal -->
<div class="modal fade" id="addSectionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSectionModal" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('section.add') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addSectionModal">Add Section</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-2">
                            <label for="year_lvl" class="form-label">Year Level</label>
                            <select class="form-select" name="year_lvl" id="year_lvl">
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>
                        <div class="col-6 mt-2">
                            <label for="program" class="form-label">Program</label>
                            <select class="form-select" name="program" id="program">
                                <option value="1">Day</option>
                                <option value="2">Evening</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <label for="course" class="form-label">Course</label>
                            @foreach($course as $courses)
                                @if ($courses['id'] == Auth::user()->course_id)
                                    <input type="text" class="form-control" name="course_name" id="course_name" value="<?= $courses['full_name']?>" disabled>
                                    <input type="hidden" class="form-control" name="course_id" id="course_id" value="<?= Auth::user()->course_id?>">
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <label for="department" class="form-label">College Department</label>
                            @foreach($college as $colleges)
                                @if ($colleges['id'] == Auth::user()->college_id)
                                    <input type="text" class="form-control" name="college_name" id="college_name" value="<?= $colleges['full_name']?>" disabled>
                                    <input type="hidden" class="form-control" name="college_id" id="college_id" value="<?= Auth::user()->college_id?>">
                                @endif
                            @endforeach
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

<!-- Edit College Modal -->
<div class="modal fade" id="editSectionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSectionModal" aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{ route('section.update') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editSectionModal">Edit Section</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" id="edit_name">
                            <input type="hidden" name="section_id" id="section_id" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-2">
                            <label for="year_lvl" class="form-label">Year Level</label>
                            <select class="form-select" name="year_lvl" id="edit_year_lvl">
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>
                        <div class="col-6 mt-2">
                            <label for="program" class="form-label">Program</label>
                            <select class="form-select" name="program" id="edit_program">
                                <option value="1">Day</option>
                                <option value="2">Evening</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <label for="course" class="form-label">Course</label>
                            @foreach($course as $courses)
                                @if ($courses['id'] == Auth::user()->course_id)
                                    <input type="text" class="form-control" name="course_name" id="edit_course_name" value="<?= $courses['full_name']?>" disabled>
                                    <input type="hidden" class="form-control" name="course_id" id="edit_course_id" value="<?= Auth::user()->course_id?>">
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <label for="department" class="form-label">College Department</label>
                            @foreach($college as $colleges)
                                @if ($colleges['id'] == Auth::user()->college_id)
                                    <input type="text" class="form-control" name="college_name" id="edit_college_name" value="<?= $colleges['full_name']?>" disabled>
                                    <input type="hidden" class="form-control" name="college_id" id="edit_college_id" value="<?= Auth::user()->college_id?>">
                                @endif
                            @endforeach
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