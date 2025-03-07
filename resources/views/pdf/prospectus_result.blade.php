<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prospectus</title>
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
        <div class="container-xl">
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
                                <p style="margin: 2px;">Republic of the Philippines</p>
                                <p style="font-weight: bold; margin: 2px;">CEBU TECHNOLOGICAL UNIVERSITY</p>
                                <p style="margin: 2px;">MAIN CAMPUS</p>
                                <p style="font-weight: bold; margin: 2px;">{{$data['course'] ?? null}}</p>
                                <p style="margin: 2px;">Effective As of AY {{$data['school_year'] ?? null}}</p>
                            </div>
                        <?php
                        $path2 = Vite::asset('resources/img/bplogo.png');
                        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
                        $data2 = file_get_contents($path2);
                        $base64_2 = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);
                        ?>
                        <img src="<?php echo $base64_2; ?>" alt="BP Logo" style="width: 120px; height: auto; display: inline-block;">
                    </div> 
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                <?php for ($year = 1; $year <= 4; $year++): ?>
                    <div class="row mt-4">
                        <div class="col-12">
                            <?php if($year == 1):?>
                                <h5 class="text-start"><?php echo $year; ?>st Year</h5>
                            <?php elseif($year == 2):?>
                                <h5 class="text-start"><?php echo $year; ?>nd Year</h5>
                            <?php elseif($year == 3):?>
                                <h5 class="text-start"><?php echo $year; ?>rd Year</h5>
                            <?php elseif ($year == 4):?>
                                <h5 class="text-start"><?php echo $year; ?>th Year</h5>
                            <?php endif;?>
                        </div>
                        <div class="col-12">
                            <table>
                                <thead>
                                    <tr>
                                        <th colspan=7>1st Semester</th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th rowspan="2">Course Code</th>
                                        <th rowspan="2">Descriptive Title</th>
                                        <th rowspan="2">Co-/Prerequisite</th>
                                        <th rowspan="2">Units</th>
                                        <th colspan="3">Hours</th>
                                    </tr>
                                    <tr>
                                        <th>Lec</th>
                                        <th>Lab</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $totalLecLab = 0; ?>
                                    <?php $totalLec = 0; ?>
                                    <?php $totalLab = 0; ?>
                                    <?php $totalUnits = 0; ?>
                                    <?php $total = 0; ?>
                                    <?php foreach($data['subjects'] as $subjects):?>
                                        <?php if($subjects['year_level'] == $year && $subjects['semester'] == 1):?>
                                            <tr>
                                                <?php $totalLecLab = $subjects['subj_lab_hours'] + $subjects['subj_lec_hours'];?>
                                                <td>{{$subjects['subj_code']}}</td>
                                                <td>{{$subjects['subj_desc']}}</td>
                                                <td>{{$subjects['subj_code']}}</td>
                                                <td>{{$subjects['subj_units']}}</td>
                                                <td>{{$subjects['subj_lec_hours']}}</td>
                                                <td>{{$subjects['subj_lab_hours']}}</td>
                                                <td>{{$totalLecLab}}</td>
                                                <?php $totalUnits += $subjects['subj_units'];?>
                                                <?php $total += $totalLecLab;?>
                                                <?php $totalLec += $subjects['subj_lec_hours'];?>
                                                <?php $totalLab += $subjects['subj_lab_hours'];?>
                                            </tr>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                    <tr>
                                        <td colspan="3" class="text-end">Total</td>
                                        <td>{{$totalUnits}}</td>
                                        <td>{{$totalLec}}</td>
                                        <td>{{$totalLab}}</td>
                                        <td>{{$total}}</td>
                                    </tr>
                                </tbody>
                            <thead>
                                <tr>
                                   <th colspan=7 style="padding: 10px"></th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th colspan=7>2nd Semester</th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th rowspan="2">Course Code</th>
                                    <th rowspan="2">Descriptive Title</th>
                                    <th rowspan="2">Co-/Prerequisite</th>
                                    <th rowspan="2">Units</th>
                                    <th colspan="3">Hours</th>
                                </tr>
                                <tr>
                                    <th>Lec</th>
                                    <th>Lab</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalLecLab = 0; ?>
                                <?php $totalLec = 0; ?>
                                <?php $totalLab = 0; ?>
                                <?php $totalUnits = 0; ?>
                                <?php $total = 0; ?>
                                <?php foreach($data['subjects'] as $subjects):?>
                                    <?php if($subjects['year_level'] == $year && $subjects['semester'] == 2):?>
                                        <tr>
                                            <?php $totalLecLab = $subjects['subj_lab_hours'] + $subjects['subj_lec_hours'];?>
                                            <td>{{$subjects['subj_code']}}</td>
                                            <td>{{$subjects['subj_desc']}}</td>
                                            <td>{{$subjects['subj_code']}}</td>
                                            <td>{{$subjects['subj_units']}}</td>
                                            <td>{{$subjects['subj_lec_hours']}}</td>
                                            <td>{{$subjects['subj_lab_hours']}}</td>
                                            <td>{{$totalLecLab}}</td>
                                            <?php $totalUnits += $subjects['subj_units'];?>
                                            <?php $total += $totalLecLab;?>
                                            <?php $totalLec += $subjects['subj_lec_hours'];?>
                                            <?php $totalLab += $subjects['subj_lab_hours'];?>
                                        </tr>
                                    <?php endif;?>
                                <?php endforeach;?>
                                <tr>
                                    <td colspan="3" class="text-end">Total</td>
                                    <td>{{$totalUnits}}</td>
                                    <td>{{$totalLec}}</td>
                                    <td>{{$totalLab}}</td>
                                    <td>{{$total}}</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
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
                filename:    `{{$data['course_2']}}` + ' AY' + `{{ $data['school_year'] }}` + (function() {
                                const today = new Date();
                                const dd = String(today.getDate()).padStart(2, '0');
                                const mm = String(today.getMonth() + 1).padStart(2, '0');
                                const yy = String(today.getFullYear()).slice(-2);
                                return mm + `-` + dd + `-` + yy;
                                })() + '.pdf',
                image:        { type: 'png', quality: 1 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' },
                pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();
        });
    </script>
</body>
</html>