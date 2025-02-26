<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Program by Room Utilization</title>
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
                                    <h3 style="font-size: 12px; font-weight: bold;" class="mt-3">PROGRAM BY ROOM UTILIZATION</h3>
                                    <?php if ($data['semester'] == 1):?>
                                        <h4 style="font-size: 12px; font-weight: bold;" class="mt-3">{{$data['semester']}}st Semester AY {{$data['school_year']}}</h4>
                                    <?php else: ?>
                                        <h4 style="font-size: 12px; font-weight: bold;" class="mt-3">{{$data['semester']}}nd Semester AY {{$data['school_year']}}</h4>
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
                                <h5 class="fw-bold">{{$data['room']}}</h5>
                                <div class="col-12">
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
                                            @endphp

                                            @foreach($data['time_slots'] as $timeslot)
                                                <tr>
                                                    <td>{{ date("h:i A", strtotime($timeslot)) }}</td>
                                                    @foreach([1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday'] as $key => $day)
                                                        @php
                                                            $isCovered = false;
                                                            // Check if this day/time slot is covered by a previous rowspan
                                                            if (isset($rowspans[$key][$timeslot]) && $rowspans[$key][$timeslot] > 0) {
                                                                $rowspans[$key][$timeslot]--;
                                                                $isCovered = true;
                                                            }
                                                        @endphp

                                                        @if($isCovered)
                                                            {{-- Skip this cell (covered by rowspan) --}}
                                                            @continue
                                                        @endif

                                                        @php
                                                            $scheduleFound = false;
                                                            foreach ($data['schedule'] as $schedule) {
                                                                if (
                                                                    $schedule['day'] == $key && 
                                                                    date("h:i A", strtotime($schedule['start_time'])) == date("h:i A", strtotime($timeslot))
                                                                ) {
                                                                    $start = strtotime($schedule['start_time']);
                                                                    $end = strtotime($schedule['end_time']);
                                                                    $diff = ($end - $start) / 3600; // 30-minute intervals
                                                                    $scheduleFound = true;
                                                                    break;
                                                                }
                                                            }
                                                        @endphp

                                                        @if($scheduleFound)
                                                            {{-- Render the cell with rowspan --}}
                                                            <td rowspan="{{ $diff }}">
                                                                {{ date("h:i A", strtotime($schedule['start_time'])) }} - {{ date("h:i A", strtotime($schedule['end_time'])) }}<br>
                                                                {{ $schedule['subj_code'] }}<br>
                                                                {{ $schedule['section_name'] }}<br>
                                                                {{ $schedule['first_name'] }} {{ $schedule['last_name'] }}
                                                            </td>

                                                            {{-- Mark subsequent time slots as covered by this rowspan --}}
                                                            @php
                                                                $currentTime = strtotime($timeslot);
                                                                for ($i = 1; $i < $diff; $i++) {
                                                                    $nextTime = date("H:i", $currentTime + 3600 * $i); // Add 30 minutes
                                                                    $rowspans[$key][$nextTime] = $diff - $i;
                                                                }
                                                            @endphp
                                                        @else
                                                            {{-- Empty cell --}}
                                                            <td></td>
                                                        @endif
                                                    @endforeach
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
                        <p class="fw-bold">Dean, {{$data['college']}}</p>
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
                    filename:     'mis.pdf',
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