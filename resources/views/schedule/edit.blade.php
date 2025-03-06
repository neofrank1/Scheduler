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
                    <form action="{{ route('schedule.updateTimeSlot') }}" method="POST">
                    @csrf
                    <div class="card-body">
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
                                                    <?php if (isset($timesched[$key]['day']) && $timesched[$key]['day'] == $key):?>
                                                        <input type="hidden" name="timeslot[days][<?= $key ?>][day]" value="<?= $timesched[$key]['day'] ?>">
                                                        <input type="hidden" name="timeslot[days][<?= $key ?>][id]" value="<?= $timesched[$key]['id'] ?>">
                                                        <input type="hidden" name="timeslot[days][<?= $key ?>][schedule_id]" value="<?= $timesched[$key]['schedule_id'] ?>">
                                                    <?php else: ?>
                                                        <input type="hidden" name="timeslot[days][<?= $key ?>][day]" value="<?= $key ?>">
                                                        <input type="hidden" name="timeslot[days][<?= $key ?>][schedule_id]" value="<?= $id ?>">
                                                    <?php endif; ?>
                                                    <label class="text-dark">Time Starts</label>
                                                    <select class="form-select" name="timeslot[days][<?= $key ?>][start_time]">
                                                        <option value="" selected disabled>Select Start Time</option>
                                                        <?php foreach ($timeSlots as $time): ?>
                                                            <?php if (isset($timesched[$key]['start_time']) && date("h:i", strtotime($timesched[$key]['start_time'])) == date("h:i", strtotime($time))):?>
                                                                <option value="<?= $timesched[$key]['start_time'] ?>" selected><?= date("h:i A", strtotime($timesched[$key]['start_time'])) ?></option>
                                                            <?php else: ?>
                                                                <option value="<?= $time ?>"><?= date("h:i A", strtotime($time)) ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="text-dark">Time Ends</label>
                                                    <select class="form-select" name="timeslot[days][<?= $key ?>][end_time]">
                                                        <option value="" selected disabled>Select End Time</option>
                                                        <?php foreach ($timeSlots as $time): ?>
                                                            <?php if (isset($timesched[$key]['end_time'] ) && date("h:i", strtotime($timesched[$key]['end_time'])) == date("h:i", strtotime($time))):?>
                                                                <option value="<?= $timesched[$key]['end_time'] ?>" selected><?= date("h:i A", strtotime($timesched[$key]['end_time'])) ?></option>
                                                            <?php else: ?>
                                                                <option value="<?= $time ?>"><?= date("h:i A", strtotime($time)) ?></option>
                                                            <?php endif; ?>
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
                    <div class="card-footer">
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