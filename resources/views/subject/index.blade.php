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
                                <h4 class="card-title mt-2">Subject List</h4>
                            </div>
                            <div class="col-6 text-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubjectModal" id="room_add">
                                <i class="fa-solid fa-plus"></i>
                                Add Subject
                            </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-primary shadow" id="table-subject">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Subject Code</th>
                                    <th>Subject Description</th>
                                    <th>Subject Prerequisite</th>
                                    <th>Subject Type</th>
                                    <th>Subject Lab Hours</th>
                                    <th>Subject Lec Hours</th>
                                    <th>Course</th>
                                    <th>Semester</th>
                                    <th>Year Level</th>
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
@extends('subject.modal')

<script type="module">
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#table-subject').dataTable({
            processing : true,
            serverSide : true,
            ajax: `{{ route('subject.home') }}`,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'subj_code', name: 'subj_code' },
                { data: 'subj_desc', name: 'subj_desc' },
                { data: 'subj_prereq', name: 'subj_prereq', searchable: false, orderable: false},
                { data: 'subj_type',
                    name: 'subj_type',
                    render: function(data, type, row) {
                        return data == 1 ? 'Major' : 'Minor';
                    },
                    searchable: false, orderable: false
                },
                { data: 'subj_lab_hours', name: 'subj_lab_hours' },
                { data: 'subj_lec_hours', name: 'subj_lec_hours' },
                { data: 'course', name: 'course', searchable: false, orderable: false },
                { data: 'semester', name: 'semester' },
                { data: 'year_level', name: 'year_level' },
                { 
                    data: null, 
                    name: 'actions', 
                    searchable: false,
                    render: function(data, type, row) {
                        if (row.status === 0) {
                            return `
                                <a type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editSubjectModal" data-id="${row.id}">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <a type="button" class="btn btn-secondary btn-activate" data-status="1" data-id="${row.id}">
                                    <i class="fa-solid fa-check"></i> Activate
                                </a>
                            `;
                        } else { 
                            return `
                                <a type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editSubjectModal" data-id="${row.id}">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <a type="button" class="btn btn-danger btn-deactivate" data-status="0" data-id="${row.id}">
                                    <i class="fa-solid fa-circle-xmark"></i> Deactivate
                                </a>
                            `;
                        } 
                    }
                }
            ],
            responsive: true
        });

        // Add button click handler
        $("#addButton").on("click", function () {
            // Clone the first subject-form
            let newForm = $(".subject-form:first").clone();

            // Clear input values in the cloned form
            newForm.find("input").val("");

            // Append the cloned form to the container
            $("#subjectFormContainer").append(newForm);
        });

        // Remove button click handler
        $("#removeButton").on("click", function () {
            // Get all the forms
            let forms = $(".subject-form");

            // Ensure at least one form remains
            if (forms.length > 1) {
                forms.last().remove();
            }
        });

         // Edit
        $('#table-subject').on('click', '.btn-edit', function() {
                var id = $(this).data('id');
                console.log(id);
            $.ajax({
                url: '/subject/getSubject/' + id,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    $('#subject_id').val(id);
                    $('#edit_subj_code').val(response.subject.subj_code);
                    $('#edit_subj_desc').val(response.subject.subj_desc);
                    $('#edit_subj_hours').val(response.subject.subj_hours);
                    $('#edit_subj_lab_hours').val(response.subject.subj_lab_hours);
                    $('#edit_subj_lec_hours').val(response.subject.subj_lec_hours);
                    $('#edit_subj_prereq').val(response.subject.subj_prereq);
                    $('#edit_subj_units').val(response.subject.subj_units);
                    var schoolYearSelect = $('#edit_school_yr');
                    var yearLevelSelect = $('#edit_year_lvl');
                    var semesterSelect = $('#edit_semester');
                    var subjTypeSelect = $('#edit_subj_type');
                    yearLevelSelect.empty(); // Clear existing options
                    schoolYearSelect.empty(); // Clear existing options
                    semesterSelect.empty(); // Clear existing options
                    subjTypeSelect.empty(); // Clear existing options
                    $.each(response.school_years, function(index, year) {
                    schoolYearSelect.append(
                        $('<option>', {
                            value: year,
                            text: year
                            })
                        );
                    });

                    $.each(response.year_level, function(index, year) {
                        yearLevelSelect.append(
                        $('<option>', {
                            value: index,
                            text: year
                            })
                        );
                    });

                    $.each(response.semester, function(index, year) {
                        semesterSelect.append(
                        $('<option>', {
                            value: index,
                            text: year
                            })
                        );
                    });

                    $.each(response.subj_type, function(index, year) {
                        subjTypeSelect.append(
                        $('<option>', {
                            value: index,
                            text: year
                            })
                        );
                    });

                    // Set the selected value manually
                    schoolYearSelect.val(response.subject.school_year);
                    yearLevelSelect.val(response.subject.year_level);
                    semesterSelect.val(response.subject.semester);
                    subjTypeSelect.val(response.subject.subj_type);
                }
            });
        });

        // Form validation
        $('#addSubjectModal, #editSubjectModal').on('submit', 'form', function(event) {
            let isValid = true;
            let errorMessage = "";

            // Validate lab hours
            let labHours = parseInt($("#subj_lab_hours").val());
            if (isNaN(labHours) || labHours <= 0) {
                isValid = false;
                errorMessage += "Lab hours must be a positive number.\n";
            }

            // Validate lecture hours
            let lecHours = parseInt($("#subj_lec_hours").val());
            if (isNaN(lecHours) || lecHours <= 0) {
                isValid = false;
                errorMessage += "Lecture hours must be a positive number.\n";
            }

            // Validate total hours
            let totalHours = labHours + lecHours;
            if (totalHours <= 0) {
                isValid = false;
                errorMessage += "Total hours must be a positive number.\n";
            }

            if (!isValid) {
                event.preventDefault();
                alert(errorMessage);
            }
        });
    });
</script>

@endsection