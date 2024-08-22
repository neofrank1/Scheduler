@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row mt-2">
                            <div class="col-6">
                                <h4 class="card-title mt-2">Professor List</h4>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProfessorModal" id="professor_add">
                                    <i class="fa-solid fa-plus"></i>
                                    Add Professor
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-primary shadow" id="table-professor">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Employee ID</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Address</th>
                                    <th>Mobile No.</th>
                                    <th>Education</th>
                                    <th>Ranking</th>
                                    <th>College</th>
                                    <th>Course</th>
                                    <th>Maximmum Hours</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@extends('faculty.modal')

<script type="module">

    $(document).ready(function() {


        $('#table-professor').DataTable({

        });

        $('#professor_add').on('click', function() {
            var college_id = '<?php echo Auth::user()->college_id;?>'
            var course_id = '<?php echo Auth::user()->course_id;?>'
            var college_name = '<?php echo $college;?>'
            var course_name = '<?php echo $course;?>'



            $('#college_id').val(college_id);
            $('#course_id').val(course_id);
        })

    });

</script>
@endsection
