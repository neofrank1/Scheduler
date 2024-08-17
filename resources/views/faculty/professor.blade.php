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
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProfessorModal">
                                    <i class="fa-solid fa-plus"></i>
                                    Add Professor
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-primary shadow" id="table-course">
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
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>Neo Frank</td>
                                    <td>Defensor</td>
                                    <td>Uy</td>
                                    <td>Hernan Cortes St. Ext. Tipolo Mandaue</td>
                                    <td>9222145350</td>
                                    <td>Masters</td>
                                    <td>Instructor 1</td>
                                    <td>College of Communication Information and Technology</td>
                                    <td>Bachelor of Science in Information Technology</td>
                                    <td>300</td>
                                    <td>Full Time Dropdown</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@extends('faculty.modal')
@endsection
