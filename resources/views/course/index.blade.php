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
                                <h4 class="card-title">Course List</h4>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                                    <i class="fa-solid fa-plus"></i>
                                    Add Course
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                       <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered table-primary shadow" id="table-course">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Short Name</th>
                                            <th>Full Name</th>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
       </div>
    </div>

    <script type="module">
        $(document).ready(function () {
            $('#table-course').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ route('course.home') }}`,
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'short_name', name: 'short_name' },
                    { data: 'full_name', name: 'full_name' },
                    { data: 'college_name', name: 'college_name', searchable: false},
                    {
                        data: null,
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            /* if (row.status === 0) {
                                return `
                                    <a href="#" type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="${row.id}">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <a href="#" type="button" class="btn btn-secondary btn-activate" data-status="1" data-id="${row.id}">
                                        <i class="fa-solid fa-check"></i> Activate
                                    </a>
                                `;
                            } else { */
                                return `
                                    <a href="#" type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editCourseModal" data-id="${row.id}">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>`
                                   /*  <a href="#" type="button" class="btn btn-danger btn-deactivate" data-status="0" data-id="${row.id}">
                                        <i class="fa-solid fa-circle-xmark"></i> Deactivate
                                    </a> */
                                ;
                          /*   } */
                        }
                    }
                ],
                responsive: true
            });


            $.ajax({
				url: '/college/collegeList/',
				type: 'GET',
				success: function(response) {
					var $select = $('#college_id');
					$select.empty(); // Clear existing options
					$select.append('<option value="" disabled selected>Select a College</option>'); // Add default option
					$.each(response, function(index, college) {
						$select.append($('<option>', {
							value: college.id,
							text: college.full_name
						}));
					});
				}
			});

			$('#college_id').on('change', function() {
                var selectedValue = $(this).val();
                var selectedText = $(this).find("option:selected").text();
            });


            $('#table-course').on('click', '.btn-edit', function() {
                var id = $(this).data('id');


                $.ajax({
                url: '/college/collegeList/',
                type: 'GET',
                success: function(response) {
                    var $select = $('#edit_college_id');
                    $select.empty(); // Clear existing options
                    $select.append('<option value="" disabled selected>Select a College</option>'); // Add default option
                        $.each(response, function(index, college) {
                            $select.append($('<option>', {
                                value: college.id,
                                text: college.full_name
                            }));
                        });
                    }
                });

                $('#edit_college_id').on('change', function() {
                    var selectedValue = $(this).val();
                    var selectedText = $(this).find("option:selected").text();
                });


                $.ajax({
                    url: '/course/getCourse/' + id,
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        $('#edit_short_name').val(response.short_name);
                        $('#edit_full_name').val(response.full_name);
                        if ($('#edit_college_id option[value="' + response.college_id + '"]').length === 1) {
                            $('#edit_college_id').append(
                                $('<option>', {
                                    value: response.college_id,
                                    text: response.college_full_name,
                                })
                            );
                        }
                        $('#edit_college_id').val(response.college_id);
                        $('#course_id').val(id);
                    }
                });
            });
        });
    </script>
@extends('course.modal')
@endsection