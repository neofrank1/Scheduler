@extends('layouts.app')
@section('content')
    <div class="container">
       <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row mt-2">
                            <div class="col-6">
                                <h4 class="card-title">PBT</h4>
                            </div>
                            <div class="col-6 text-end">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                       <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered table-primary shadow" id="table-prospectus">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Semester</th>
                                            <th>Professor</th>
                                            <th>School Year</th>
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

@extends('course.modal')

    <script type="module">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#table-prospectus').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: `{{ route('pdf.pbt.home') }}`,
                    type: 'GET',
                    dataSrc: function (json) {
                        console.log(json);
                        return json.data;
                    }
                },
                columns: [
                    { data: 'prof_id', name: 'id' },
                    {
                        data: 'semester',
                        name: 'program',
                        render: function(data, type, row) {
                            return data == 1 ? '1st Semester' : '2nd Semester';
                        }
                    },
                    {
                        data: null,
                        name: 'section',
                        render: function(data, type, row) {
                            return `${row.first_name} ${row.last_name}`;
                        }
                    },
                    { data: 'school_yr', name: 'school_yr' },
                    {
                        data: null,
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) 
                        {
                            return `
                                <a type="button" class="btn btn-success btn-edit" href="/pdf/generatePBT/${row.prof_id}/${row.semester}/${row.school_yr}">
                                    <i class="fa-solid fa-pen"></i> Download PDF
                                </a>`
                        } 
                    }
                ],
                responsive: true
            });

        });
    </script>
@endsection