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
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('schedule.update') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="" class="form-label">School Year</label>
                                <select class="form-select" name="school_year">
                                    <?php 
                                    $date2 = date('Y', strtotime('+1 Years'));
                                    for ($i = date('Y'); $i < $date2 + 5; $i++) {
                                        if ($schedule['school_year'] == $i.'-'.($i+1)) {
                                            echo '<option value="'.$i.'-'.($i+1).'" selected>'.$i.'-'.($i+1).'</option>';
                                        } else {
                                            echo '<option value="'.$i.'-'.($i+1).'">'.$i.'-'.($i+1).'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="" class="form-label">Semester</label>
                                <select class="form-select" name="semester">
                                    <?php 
                                    $semesters = ['1st', '2nd', 'Trimester'];
                                        foreach ($semesters as $key => $semester) {
                                            if ($schedule['semester'] == $key+1) {
                                                echo '<option value="'.($key+1).'" selected>'.$semester.'</option>';
                                            } else {
                                                echo '<option value="'.($key+1).'">'.$semester.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="" class="form-label">Section</label>
                                <select class="form-select" name="section_id">
                                    <option disabled selected>Choose Section</option>
                                    <?php foreach ($sections as $section): ?>
                                        <?php if ($schedule['section_id'] == $section['id']): ?>
                                            <option value="<?= $section['id'] ?>" selected><?= $section['name'] ?></option>
                                        <?php else: ?>
                                            <option value="<?= $section['id'] ?>"><?= $section['name'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="subj_code" class="form-label">Select Subject</label>
                                <select class="form-select" name="subject_id">
                                    <option disabled selected>Choose Subject</option>
                                    <?php foreach ($subjects as $subject): ?>
                                        <?php if ($schedule['subject_id'] == $subject['id']): ?>
                                            <option value="<?= $subject['id'] ?>" selected><?= $subject['subj_code'] ?></option>
                                        <?php else: ?>
                                            <option value="<?= $subject['id'] ?>"><?= $subject['subj_code'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="subj_desc" class="form-label">Select Professor</label>
                                <select class="form-select" name="professor_id">
                                    <option disabled selected>Choose Professor</option>
                                    <?php foreach ($professors as $professor): ?>
                                        <?php if ($schedule['prof_id'] == $professor['id']): ?>
                                            <option value="<?= $professor['id'] ?>" selected><?= $professor['first_name'].' '.$professor['middle_name'].' '.$professor['last_name'] ?></option>
                                        <?php else: ?>
                                            <option value="<?= $professor['id'] ?>"><?= $professor['first_name'].' '.$professor['middle_name'].' '.$professor['last_name'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="subj_hrs" class="form-label">Select Room</label>
                                <select class="form-select" name="room_id">
                                    <option disabled selected>Choose Room</option>
                                    <?php foreach ($rooms as $room): ?>
                                        <?php if ($schedule['room_id'] == $room['id']): ?>
                                            <option value="<?= $room['id'] ?>" selected><?= $room['building_name'].'-'.$room['floor_number'].'-'.$room['room_number'] ?></option>
                                        <?php else: ?>
                                            <option value="<?= $room['id'] ?>"><?= $room['building_name'].'-'.$room['floor_number'].'-'.$room['room_number'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="id" value="{{ $schedule['id'] }}">
                        <div class="row">
                            <div class="col-12 text-end">
                                <a href="{{ route('schedule.home') }}" class="btn btn-secondary">Back</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script type="module">

    $(document).ready(function () {

    });

</script>

@endsection