<!-- Add Room Modal -->
<div class="modal fade" id="addSubjectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSubjectModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('subject.add') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addSubjectModal">Add Subject</h1>
                    <div class="d-flex align-items-center ms-auto" style="gap: 10px;">
                        <!-- Add spacing between buttons -->
                        <button type="button" class="btn btn-primary" id="addButton" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Add Subject"><i class="fa-regular fa-square-plus"></i></button>
                        <button type="button" class="btn btn-danger" id="removeButton" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Remove Subject"><i class="fa-regular fa-square-minus"></i></button>
                        <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="form-label">School Year</label>
                            <select class="form-select" placeholder="Choose School Year" name="school_yr">
                                <?php $date2=date('Y', strtotime('+1 Years'));
                                    for($i=date('Y'); $i<$date2+5;$i++){
                                        echo '<option value='.$i.'-'.($i+1).'>'.$i.'-'.($i+1).'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Year Level</label>
                            <select class="form-select" name="year_lvl">
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Semester</label>
                            <select class="form-select" name="semester">
                                    <option value="1">1st</option>
                                    <option value="2">2nd</option>
                            </select>
                        </div>
                    </div>
                    <div id="subjectFormContainer">
                        <div class="subject-form">
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="subj_code" class="form-label">Subject Code</label>
                                    <input type="text" class="form-control" name="subj_code[]" id="subj_code" required>
                                </div>
                                <div class="col-4">
                                    <label for="subj_desc" class="form-label">Subject Description</label>
                                    <input type="text" class="form-control" name="subj_desc[]" id="subj_desc" required>
                                </div>
                                <div class="col-4">
                                    <label for="subj_hrs" class="form-label">Subject Hours</label>
                                    <input type="text" class="form-control" name="subj_hours[]" id="subj_hours" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="subj_lab_hours" class="form-label">Subject Lab Hours</label>
                                    <input type="text" class="form-control" name="subj_lab_hours[]" id="subj_lab_hours" required>
                                </div>
                                <div class="col-4">
                                    <label for="subj_lec_hours" class="form-label">Subject Lec Hours</label>
                                    <input type="text" class="form-control" name="subj_lec_hours[]" id="subj_lec_hours" required>
                                </div>
                                <div class="col-4">
                                    <label for="subj_prereq" class="form-label">Subject Prerequisite</label>
                                    <input type="text" class="form-control" name="subj_prereq[]" id="subj_prereq" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="subj_type" class="form-label">Subject Type</label>
                                    <!-- <input type="text" class="form-control" name="subj_type[]" id="subj_type"> -->
                                     <select class="form-select" name="subj_type[]">
                                        <option value="1">Major</option>
                                        <option value="2">Minor</option>
                                     </select>
                                </div>
                                <div class="col-4">
                                    <label for="subj_units" class="form-label">Subject Unit</label>
                                    <input type="text" class="form-control" name="subj_units[]" id="subj_units" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="sumbit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Room Modal -->
<div class="modal fade" id="editSubjectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSubjectModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('subject.update') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editSubjectModal">Edit Subject</h1>
                    <div class="d-flex align-items-center ms-auto" style="gap: 10px;">
                        <!-- Add spacing between buttons -->
                        <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="form-label">School Year</label>
                            <select class="form-select" placeholder="Choose School Year" name="school_year" id="edit_school_yr" required>
                                
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Year Level</label>
                            <select class="form-select" name="year_level" id="edit_year_lvl" required>
                
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Semester</label>
                            <select class="form-select" name="semester" id="edit_semester">
                                    <option value="1">1st</option>
                                    <option value="2">2nd</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="subj_code" class="form-label">Subject Code</label>
                            <input type="text" class="form-control" name="subj_code" id="edit_subj_code" required>
                        </div>
                        <div class="col-4">
                            <label for="subj_desc" class="form-label">Subject Description</label>
                            <input type="text" class="form-control" name="subj_desc" id="edit_subj_desc" required>
                        </div>
                        <div class="col-4">
                            <label for="subj_hrs" class="form-label">Subject Hours</label>
                            <input type="text" class="form-control" name="subj_hours" id="edit_subj_hours" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="subj_lab_hours" class="form-label">Subject Lab Hours</label>
                            <input type="text" class="form-control" name="subj_lab_hours" id="edit_subj_lab_hours" required>
                        </div>
                        <div class="col-4">
                            <label for="subj_lec_hours" class="form-label">Subject Lec Hours</label>
                            <input type="text" class="form-control" name="subj_lec_hours" id="edit_subj_lec_hours" required>
                        </div>
                        <div class="col-4">
                            <label for="subj_prereq" class="form-label">Subject Prerequisite</label>
                            <input type="text" class="form-control" name="subj_prereq" id="edit_subj_prereq" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="subj_type" class="form-label">Subject Type</label>
                            <!-- <input type="text" class="form-control" name="subj_type[]" id="subj_type"> -->
                                <select class="form-select" name="subj_type" id="edit_subj_type">

                                </select>
                        </div>
                        <div class="col-4">
                            <label for="subj_units" class="form-label">Subject Unit</label>
                            <input type="text" class="form-control" name="subj_units" id="edit_subj_units" required>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <input type="hidden" name="subject_id" id="subject_id">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="sumbit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>