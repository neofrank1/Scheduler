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
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row mt-2">
                            <div class="col-6">
                                <h4 class="card-title mt-2">Chairperson List</h4>
                            </div>
                            <div class="col-6 text-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSectionModal" id="section_add">
                                <i class="fa-solid fa-plus"></i>
                                Add Room
                            </button>
                    </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-primary shadow" id="table-chairperson">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Building Name</th>
                                    <th>Floor Number</th>
                                    <th>Room Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection