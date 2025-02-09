@extends('layouts.app')
@section('content')
    <div class="container">
       <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row mt-2">
                            <div class="col-6">
                                <h4 class="card-title">MIS</h4>
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
                                            <th>Section</th>
                                            <th>Program</th>
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
                searching : false,
                ajax: `{{ route('pdf.mis.home') }}`,
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'section' },
                    {
                        data: 'program',
                        name: 'program',
                        render: function(data, type, row) {
                            return data == 1 ? 'Day' : 'Night';
                        }
                    },
                    {
                        data: null,
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) 
                        {
                            return `
                                <a type="button" class="btn btn-success btn-edit" href="/pdf/generateMIS/${row.id}">
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