@extends('admin.app.app')
@section('title', 'Destinations')
{{-- @section('page-title', 'List of Destinations') --}}
@section('css')
    <style>
        .toggle-destination {
            transition: all 0.3s ease;
            min-width: 90px;
        }

        .toggle-destination:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="row">



        <div class="col-12">
            <div class="card card-h-100">
                <div class="card-header d-flex flex-wrap border-bottom border-dashed align-items-center gap-3">
                    <h4 class="header-title me-auto">All Destinations</h4>
                    <a href="{{ route('admin.destination.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="card-body pt-1" id="DataTable">

                    <table class="table table-hover table-centered table-bordered mb-0 dt-datatable">
                        <thead class="table-light">
                            <tr>
                                <th> Image</th>
                                <th data-sortable="true">Destination</th>
                                <th data-sortable="true"> Starting Amout</th>
                                <th data-sortable="true">Type</th>
                                <th data-sortable="true">Status</th>
                                <th data-sortable="true">Featured</th>
                                <th data-sortable="true"> Created At</th>
                                <th data-sortable="true"> Updated At</th>
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
            const datatable = new SaarniJs('DataTable', "{{ route('admin.destination.index') }}", 'User List');
            // const datatable = new SaarniJs();
            document.getElementById('reloadDatatable').addEventListener('click', (e) => {
                // datatable.render(datatable.rootUrl);
                datatable.ajaxReload();
            })
        });
    </script>
    {{-- the below AJAX code is for the status toggle  --}}
    <script>
        document.addEventListener('click', function(e) {
            const toggleBtn = e.target.closest('.toggle-destination');
            if (toggleBtn) {
                e.preventDefault();
                const uuid = toggleBtn.dataset.uuid;
                const icon = toggleBtn.querySelector('i');
                const statusText = toggleBtn.querySelector('.status-text');

                fetch("{{ route('admin.destination.toggle') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            uuid: uuid
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update button classes
                            toggleBtn.classList.remove('btn-success', 'btn-danger');
                            toggleBtn.classList.add(data.status ? 'btn-success' : 'btn-danger');

                            // Update icon
                            icon.className = `ti ${data.status ? 'ti-eye' : 'ti-eye-off'} me-1`;

                            // Update text
                            statusText.textContent = data.status ? 'Active' : 'Inactive';
                        }
                    })
                    .catch(error => console.error("Error:", error));
            }
        });
    </script>

    {{-- the below AJAX code is for the featured toggle --}}
    <script>
        document.addEventListener('click', function(e) {
            const toggleBtn = e.target.closest('.toggle-item');

            if (toggleBtn) {
                e.preventDefault();
                const uuid = toggleBtn.dataset.uuid;
                const field = toggleBtn.dataset.field;
                const type = toggleBtn.dataset.type;
                const icon = toggleBtn.querySelector('i');
                const statusText = toggleBtn.querySelector('.status-text');

                fetch("{{ route('admin.destination.toggle_featured') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            uuid,
                            field,
                            type
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update button classes
                            toggleBtn.classList.remove('btn-success', 'btn-danger');
                            toggleBtn.classList.add(data.status ? 'btn-success' : 'btn-danger');

                            // Update icon
                            icon.className = `ti ${data.status ? 'ti-star' : 'ti-star-off'} me-1`;

                            // Update text
                            statusText.textContent = data.status ? 'Featured' : 'Not Featured';
                        }
                    })
                    .catch(error => console.error("Error:", error));
            }
        });
    </script>

@endsection
