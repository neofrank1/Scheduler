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
                                <table class="table table-bordered table-primary shadow-sm" id="table">
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
                                            @if ($datas->status == 1)
                                                <tr class="list">
                                                    <td><?php echo $datas->id; ?></td>
                                                    <td><?php echo $datas->short_name; ?></td>
                                                    <td><?php echo $datas->full_name; ?></td>
                                                    <td>
                                                        <a href="" type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id={{ $datas->id }}>
                                                            <i class="fa-solid fa-pen"></i>
                                                            Edit
                                                        </a>
                                                        <a type="button" class="btn btn-danger btn-deactivate" data-status="0" data-id={{ $datas->id }}>
                                                            <i class="fa-solid fa-circle-xmark"></i>
                                                            Deactivate
                                                        </a>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr class="list table-active">
                                                    <td><?php echo $datas->id; ?></td>
                                                    <td><?php echo $datas->short_name; ?></td>
                                                    <td><?php echo $datas->full_name; ?></td>
                                                    <td>
                                                        <a href="" type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id={{ $datas->id }}>
                                                            <i class="fa-solid fa-pen"></i>
                                                            Edit
                                                        </a>
                                                        <a type="button" class="btn btn-secondary btn-activate" data-status="1" data-id={{ $datas->id }}>
                                                            <i class="fa-solid fa-check"></i>
                                                            Activate
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
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

    <script type="module">
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#table').DataTable();

            $('.btn-edit').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    url: '/college/getCollege/' + id,
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        $('#edit_short_name').val(response.short_name);
                        $('#edit_full_name').val(response.full_name);
                        $('#college_id').val(id);
                    }
                });
            });

            $('.btn-deactivate').on('click', function() {
                var id = $(this).data('id');
                var status = $(this).data('status');

                $.ajax({
                    url: '{{ route('college.status') }}',
                    type: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            window.location.reload();
                        } else {
                            alert('Failed to update status');
                        }
                    }
                });
            });

            $('.btn-activate').on('click', function() {
                var id = $(this).data('id')
                var status = $(this).data('status');

                $.ajax({
                    url: '{{ route('college.status') }}',
                    type: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            window.location.reload();
                        } else {
                            alert('Failed to update status');
                        }
                    }
                });
            });
        });
    </script>

@endsection