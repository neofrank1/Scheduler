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
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProfessorModal" id="professor_add">
                            <i class="fa-solid fa-plus"></i>
                            Add Section
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table table-bordered table-primary shadow">
                    
                </div>
            </div>
        </div>
    </div>
@endsection