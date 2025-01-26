<!-- Add Schedule and TimeSlot -->
<div class="modal fade" id="addScheduleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addScheduleModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('schedule.add') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addScheduleModal">Add Schedule</h1>
                    <div class="d-flex align-items-center ms-auto" style="gap: 10px;">
                        <button type="button" class="btn btn-primary" id="addButton" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Add Subject"><i class="fa-regular fa-square-plus"></i></button>
                        <button type="button" class="btn btn-danger" id="removeButton" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Remove Subject"><i class="fa-regular fa-square-minus"></i></button>
                        <button type="button" class="btn-close ms-2" id="clearButton" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="form-label">School Year</label>
                            <select class="form-select" name="school_year">
                                <?php 
                                $date2 = date('Y', strtotime('+1 Years'));
                                for ($i = date('Y'); $i < $date2 + 5; $i++) {
                                    echo '<option value="'.$i.'-'.($i+1).'">'.$i.'-'.($i+1).'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Semester</label>
                            <select class="form-select" name="semester">
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">Trimester</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Section</label>
                            <select class="form-select" name="section_id">
                                <option disabled selected>Choose Section</option>
                                <?php foreach ($sections as $section): ?>
                                    <option value="<?= $section['id'] ?>"><?= $section['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div id="subjectFormContainer">
                        <div class="subject-form">
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="subj_code" class="form-label">Select Subject</label>
                                    <select class="form-select" name="subjects[0][subject_id]">
                                        <option disabled selected>Choose Subject</option>
                                        <?php foreach ($subjects as $subject): ?>
                                            <option value="<?= $subject['id'] ?>"><?= $subject['subj_code'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="subj_desc" class="form-label">Select Professor</label>
                                    <select class="form-select" name="subjects[0][professor_id]">
                                        <option disabled selected>Choose Professor</option>
                                        <?php foreach ($professors as $professor): ?>
                                            <option value="<?= $professor['id'] ?>"><?= $professor['first_name'].' '.$professor['middle_name'].' '.$professor['last_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="subj_hrs" class="form-label">Select Room</label>
                                    <select class="form-select" name="subjects[0][room_id]">
                                        <option disabled selected>Choose Room</option>
                                        <?php foreach ($rooms as $room): ?>
                                            <option value="<?= $room['id'] ?>"><?= $room['building_name'].'-'.$room['floor_number'].'-'.$room['room_number'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <?php 
                                    $days = [
                                        1 => 'Monday',
                                        2 => 'Tuesday',
                                        3 => 'Wednesday',
                                        4 => 'Thursday',
                                        5 => 'Friday',
                                        6 => 'Saturday',
                                        7 => 'Sunday'
                                    ];

                                    $timeSlots = [
                                        '07:00', '08:00', '09:00', '10:00', '11:00', '12:00',
                                        '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00'
                                    ];
                                ?>

                                <?php foreach ($days as $key => $day): ?>
                                    <div class="col-sm-3">
                                        <div class="card mt-3 mb-4">
                                            <div class="card-header">
                                                <h6 class="day-heading text-dark"><?= htmlspecialchars($day) ?></h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <input type="hidden" name="subjects[0][days][<?= $key ?>][day]" value="<?= $key ?>">
                                                        <label class="text-dark">Time Starts</label>
                                                        <select class="form-select" name="subjects[0][days][<?= $key ?>][start_time]">
                                                            <option value="" selected disabled>Select Start Time</option>
                                                            <?php foreach ($timeSlots as $time): ?>
                                                                <option value="<?= $time ?>"><?= date("h:i A", strtotime($time)) ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="text-dark">Time Ends</label>
                                                        <select class="form-select" name="subjects[0][days][<?= $key ?>][end_time]">
                                                            <option value="" selected disabled>Select End Time</option>
                                                            <?php foreach ($timeSlots as $time): ?>
                                                                <option value="<?= $time ?>"><?= date("h:i A", strtotime($time)) ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

