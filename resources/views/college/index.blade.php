@extends('layouts.app')

@section('content')
    <div class="container">
       <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row mt-2">
                            <div class="col-6">
                                <h4 class="card-title">College Department List</h4>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <i class="fa-solid fa-plus"></i>
                                    Add Department
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-primary">
                                    <thead>
                                        <tr>
                                            <td>No.</td>
                                            <td>Short Name</td>
                                            <td>Full Name</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach ($data as $datas):?>
                                        <tr>
                                            <td><?php echo $datas->id; ?></td>
                                            <td><?php echo $datas->short_name; ?></td>
                                            <td><?php echo $datas->full_name; ?></td>
                                            <td>
                                                <a href="" type="button" class="btn btn-success">
                                                    <i class="fa-solid fa-pen"></i>
                                                    Edit
                                                </a>
                                                <a href="" type="button" class="btn btn-danger">
                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                    Deactivate
                                                </a>
                                            </td>
                                        </tr>
                                       <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
@extends('college.modal');
@endsection