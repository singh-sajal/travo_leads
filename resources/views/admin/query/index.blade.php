@extends('admin.app.app')
@section('title', 'Querys')
{{-- @section('page-title', 'List of querys') --}}
@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-h-100">
                <div class="card-header d-flex flex-wrap border-bottom border-dashed align-items-center gap-3">
                    <h4 class="header-title me-auto">All querys</h4>
                    <a href="{{ route('admin.query.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="card-body pt-1" id="DataTable">

                    <table class="table table-hover table-centered table-bordered mb-0 dt-datatable">
                        <thead class="table-light">
                            <tr>
                                <th data-sortable="true"> Name</th>
                                <th data-sortable="true">Email</th>
                                <th data-sortable="true"> Phone</th>
                                <th data-sortable="true">City</th>
                                <th data-sortable="true"> Created At</th>
                                <th> Actions</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div>
    </div>
@endsection
@section('javascripts')
    <script src="{{ asset('admin/assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/assets/js/saarni.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const datatable = new SaarniJs('DataTable', "{{ route('admin.query.index') }}", 'User List');
            // const datatable = new SaarniJs();
            document.getElementById('reloadDatatable').addEventListener('click', (e) => {
                // datatable.render(datatable.rootUrl);
                datatable.ajaxReload();
            })
        });
    </script>
@endsection
