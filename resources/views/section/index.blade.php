@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-header">
                <div class="row mt-2">
                    <div class="col-6">
                        <h4 class="card-title mt-2">Section List</h4>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSectionModal" id="section_add">
                            <i class="fa-solid fa-plus"></i>
                            Add Section
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-primary shadow" id="table-section">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Short Name</th>
                            <th>Year Level</th>
                            <th>College Department</th>
                            <th>College Course</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@extends('section.modal')

<script type="module">
    $(document).ready(function() {
        $('#table-section').dataTable({
            
        });
    });
</script>
@endsection