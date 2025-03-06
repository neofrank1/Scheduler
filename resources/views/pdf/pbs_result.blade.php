<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Program by Section</title>
    @vite(['resources/sass/app.scss','resources/css/app.css', 'resources/js/app.js'])
    <style>
         * {
            font-family: 'arial', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #333;
            text-align: center;
            padding: 2px;
        }
        th {
            font-weight: bold;
        }
    </style>
</head>
    <body>
        <div id="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                        <div class="col-12 text-center">
                            <?php
                            $path = Vite::asset('resources/img/ctulogo.png');
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $datas = file_get_contents($path);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($datas);
                            ?>
                            <img src="<?php echo $base64; ?>" alt="CTU Logo" style="width: 100px; height: auto; display: inline-block;">
                                <div style="display: inline-block; vertical-align: middle; margin: 0 10px;">
                                    <h3 style="font-size: 12px;">Republic of the Philippines</h3>
                                    <h2 style="font-size: 14px; font-weight: bold; margin: 0">CEBU TECHNOLOGICAL UNIVERSITY</h2>
                                    <p style="font-size: 14px; margin: 0;">Main Campus</p>
                                    <p style="font-size: 10px; margin: 0;">M. J. Cuenco Avenue Cor. R. Palma Street, Cebu City, Philippines</p>
                                    <p style="font-size: 10px; margin: 0;">Website: www.ctu.edu.ph | Email: thepresident@ctu.edu.ph</p>
                                    <p style="font-size: 10px; margin: 0;">Phone: +6332 402 460 loc. 1137</p>
                                    <h3 style="font-size: 12px; font-weight: bold;" class="mt-2">{{$data['college']}}</h3>
                                    <h3 style="font-size: 12px; font-weight: bold;" class="mt-3">PROGRAM BY SECTION</h3>
                                    <h3 style="font-size: 12px;">{{ strtoupper($data['program']) }} PROGRAM</h3>
                                    <?php if ($data['semester'] == 1):?>
                                        <h4 style="font-size: 12px; font-weight: bold;" class="mt-1">{{$data['semester']}}st Semester AY {{$data['school_year']}}</h4>
                                    <?php else: ?>
                                        <h4 style="font-size: 12px; font-weight: bold;" class="mt-1">{{$data['semester']}}nd Semester AY {{$data['school_year']}}</h4>
                                    <?php endif; ?>
                                </div>
                            <?php
                            $path2 = Vite::asset('resources/img/bplogo.png');
                            $type2 = pathinfo($path2, PATHINFO_EXTENSION);
                            $data2 = file_get_contents($path2);
                            $base64_2 = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);
                            ?>
                            <img src="<?php echo $base64_2; ?>" alt="BP Logo" style="width: 120px; height: auto; display: inline-block;">
                        </div> 
                        
                        <div class="container-fluid">
                            <div class="row mb-8 mt-5">
                                <div class="col-6">
                                    <p style="margin: 0;">Degree Year & Section: {{$data['section']}} {{$data['program']}}</p>
                                </div>
                                <div class="col-6">
                                    <p style="margin: 0;">Major:</p>
                                </div>
                                <div class="col-6">
                                    <p style="margin: 0;">Adviser:</p>
                                </div>
                                <div class="col-6">
                                    <p style="margin: 0;">Assignment:</p>
                                </div>
                                <div class="col-4">
                                    <table style="font-size: 10px;">
                                        <thead class="fw-bold">
                                            <tr>
                                                <td colspan="2">SUMMARY OF COURSES</td>
                                            </tr>
                                        </thead>
                                        <thead class="fw-bold">
                                            <tr>
                                                <td>Course Code</td>
                                                <td>Descriptive Title</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['summary'] as $summary)
                                                <tr>
                                                    <td>{{ $summary['subj_code'] }}</td>
                                                    <td>{{ $summary['subj_desc'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-8">
                                <table id="data_table" style="font-size: 10px;">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                                    <th>{{ $day }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                // Track rowspans for each day and time slot
                                                $rowspans = array_fill(1, 7, []); // 7 days (1-7)
                                                $colspans = []; // Track colspan merges
                                            @endphp

                                            @foreach($data['time_slots'] as $timeslot)
                                                <tr>
                                                    <td>{{ date("h:i A", strtotime($timeslot)) }}</td>
                                                    @php $currentDay = 1; @endphp
                                                    @while($currentDay <= 7)
                                                        @php
                                                            // Skip if covered by previous rowspan
                                                            if (isset($rowspans[$currentDay][$timeslot]) && $rowspans[$currentDay][$timeslot] > 0) {
                                                                $rowspans[$currentDay][$timeslot]--;
                                                                $currentDay++;
                                                                continue;
                                                            }

                                                            $scheduleFound = false;
                                                            $colspan = 1;
                                                            $matchingSchedule = null;

                                                            // Find schedule for current day
                                                            foreach ($data['schedule'] as $schedule) {
                                                                if (
                                                                    $schedule['day'] == $currentDay && 
                                                                    date("h:i A", strtotime($schedule['start_time'])) == date("h:i A", strtotime($timeslot))
                                                                ) {
                                                                    $scheduleFound = true;
                                                                    $matchingSchedule = $schedule;
                                                                    
                                                                    // Check subsequent days for same schedule
                                                                    $nextDay = $currentDay + 1;
                                                                    while ($nextDay <= 7) {
                                                                        $foundMatch = false;
                                                                        foreach ($data['schedule'] as $nextSchedule) {
                                                                            if (
                                                                                $nextSchedule['day'] == $nextDay &&
                                                                                $nextSchedule['start_time'] == $schedule['start_time'] &&
                                                                                $nextSchedule['end_time'] == $schedule['end_time'] &&
                                                                                $nextSchedule['room_number'] == $schedule['room_number'] &&
                                                                                $nextSchedule['first_name'] == $schedule['first_name'] &&
                                                                                $nextSchedule['last_name'] == $schedule['last_name']
                                                                            ) {
                                                                                $colspan++;
                                                                                $foundMatch = true;
                                                                                break;
                                                                            }
                                                                        }
                                                                        if (!$foundMatch) break;
                                                                        $nextDay++;
                                                                    }
                                                                    break;
                                                                }
                                                            }
                                                        @endphp

                                                        @if($scheduleFound)
                                                            @php
                                                                $start = strtotime($matchingSchedule['start_time']);
                                                                $end = strtotime($matchingSchedule['end_time']);
                                                                $diff = ($end - $start) / 3600;
                                                            @endphp
                                                            <td colspan="{{ $colspan }}" rowspan="{{ $diff }}">
                                                                {{ date("h:i A", strtotime($matchingSchedule['start_time'])) }} - {{ date("h:i A", strtotime($matchingSchedule['end_time'])) }}<br>
                                                                {{ $matchingSchedule['subj_code'] }}<br>
                                                                {{ $matchingSchedule['building_name'] }} {{$matchingSchedule['floor_number']}}{{ str_pad($matchingSchedule['room_number'], 2, '0', STR_PAD_LEFT) }} <br>
                                                                {{ $matchingSchedule['first_name'] }} {{ $matchingSchedule['last_name'] }}
                                                            </td>

                                                            @php
                                                                // Mark rowspans
                                                                $currentTime = strtotime($timeslot);
                                                                for ($i = 1; $i < $diff; $i++) {
                                                                    $nextTime = date("H:i", $currentTime + 3600 * $i);
                                                                    for ($d = $currentDay; $d < $currentDay + $colspan; $d++) {
                                                                        $rowspans[$d][$nextTime] = $diff - $i;
                                                                    }
                                                                }
                                                                $currentDay += $colspan;
                                                            @endphp
                                                        @else
                                                            <td></td>
                                                            @php $currentDay++; @endphp
                                                        @endif
                                                    @endwhile
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
                
                <div class="row justify-content-start mt-3">
                    <div class="col-4">
                        <p class="fw-bold" style="position: absolute; left: 130px;">Prepared by:</p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold text-start">Review, Certified True and Correct:</p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold" style="position: relative; left: 100px;">Approved by:</p>
                    </div> 
                </div>
                <div class="row justify-content-center mt-5">
                    <div class="col-4 text-center">
                        <p class="fw-bold">_________________________________</p>
                    </div>
                    <div class="col-4 text-center">
                        <p class="fw-bold">__________________________________</p>
                    </div>
                    <div class="col-4 text-center">
                        <p class="fw-bold">__________________________________</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-4 text-center">
                        <p class="fw-bold">Program Coordinator/Chair</p>
                    </div>
                    <div class="col-4 text-center">
                        <p class="fw-bold">Dean, {{$data['course']}}</p>
                    </div>
                    <div class="col-4 text-center">
                        <p class="fw-bold">Campus Director, CTU-Main Campus</p>
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="col-12 text-center">
                        <p class="fw-bold">__________________________________</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <p class="fw-bold">Dean, CAS</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-12 text-center">
                <button id="download" class="btn btn-primary mt-2">Download PDF</button>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
        <script>
            document.getElementById('download').addEventListener('click', function () {
                var element = document.getElementById('content');
                var opt = {
                    margin:       0.5,
                    filename:    `{{$data['section']}} {{$data['program']}}` + '_PBS_' + (function() {
                        const today = new Date();
                        const dd = String(today.getDate()).padStart(2, '0');
                        const mm = String(today.getMonth() + 1).padStart(2, '0');
                        const yy = String(today.getFullYear()).slice(-2);
                        return mm + `-` + dd + `-` + yy;
                    })() + '.pdf',
                    image:        { type: 'png', quality: 1 },
                    html2canvas:  { scale: 1 },
                    jsPDF:        { unit: 'in', format: 'tabloid', orientation: 'landscape' },
                    pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
                };

                // New Promise-based usage:
                html2pdf().set(opt).from(element).save();
            });
        </script>
    </body>
</html>