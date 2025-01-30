<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subjects</title>
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
            <div class="row justify-content-center mt-2">
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
                                <h3 style="font-size: 12px; font-weight: bold;" class="mt-2">CCICT</h3>
                                <h3 style="font-size: 12px; font-weight: bold;" class="mt-3">CLASS PROGRAM FOR MIS</h3>
                                <h4 style="font-size: 12px; font-weight: bold;" class="mt-3">1st Semester SY 2024 - 2025</h4>
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
                filename:     'myfile.pdf',
                image:        { type: 'png', quality: 1 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' },
                pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();
        });
    </script>
</body>
</html>