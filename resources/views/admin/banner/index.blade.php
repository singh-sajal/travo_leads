@extends('admin.app.app')
@section('title', 'Banners')
@section('page-title', 'Banners')
@section('css')

@endsection

@section('content')

    <div class="col-12">
        <div class="mb-2 d-flex justify-content-end">
            <a href="{{ route('admin.banner.create') }}" class="btn btn-primary">Add New</a>
        </div>
    </div>
    <div class="row g-3">
        @forelse ($banners as $banner)
            <div class="col-md-6 col-lg-6">
                <div class="card shadow-sm position-relative">
                    <div class="card-body text-center">
                        <!-- Show Button (Top Right) -->
                        <a href="{{ route('admin.banner.toggle') }}" class="btn btn-sm btn-primary position-absolute top-0 end-0 m-2 toggle-banner"
                            data-uuid="{{ $banner->uuid }}" data-status="{{ $banner->status }}">
                            <i class="{{ $banner->status ? 'ti ti-eye' : 'fa-solid fa-eye-slash' }}"></i>
                        </a>
                        {{-- <button class="btn btn-{{ $banner->status ? 'success' : 'danger' }} btn-xs btn-pill position-absolute top-0 end-0 m-2 toggle-banner"
                            data-uuid="{{ $banner->uuid }}"
                            data-type="banner"
                            data-field="status">
                            <i class="ti {{ $banner->status ? 'ti-eye' : 'ti-eye-off' }} me-1"></i>
                            <span class="status-text">{{ $banner->status ? 'Active' : 'Inactive' }}</span>
                        </button> --}}


                        <!-- Banner Image -->
                        <div class="my-3">
                            <img id="banner-{{ $banner->uuid }}" src="{{ asset($banner->url) }}" alt="Banner"
                                class="rounded w-100 img-fluid" style="max-height: 250px; object-fit: cover;">
                        </div>

                        <!-- Delete Button (Bottom Right) -->
                        <form action="{{ route('admin.banner.destroy', $banner->uuid) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger position-absolute bottom-0 end-0 m-2">
                                <i class="ti ti-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No banners available to display</p>
        @endforelse
    </div>





@endsection
@section('javascripts')
    <script src="{{ asset('admin/assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/assets/js/saarni.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const datatable = new SaarniJs('DataTable', "{{ route('admin.banner.index') }}", 'User List');
            // const datatable = new SaarniJs();
            document.getElementById('reloadDatatable').addEventListener('click', (e) => {
                // datatable.render(datatable.rootUrl);
                datatable.ajaxReload();
            })
        });
    </script>
    {{-- the below AJAX code is for the display banner toggle  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-banner').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    let uuid = this.dataset.uuid;
                    let icon = this.querySelector('i'); // Select the icon inside the button

                    fetch("{{ route('admin.banner.toggle') }}", {
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
                                // Toggle the icon based on new status
                                if (data.status) {
                                    icon.classList.remove('fa-eye-slash', 'fa-solid');
                                    icon.classList.add('ti', 'ti-eye');
                                } else {
                                    icon.classList.remove('ti', 'ti-eye');
                                    icon.classList.add('fa-solid', 'fa-eye-slash');
                                }
                            }
                        })
                        .catch(error => console.error("Error:", error));
                });
            });
        });
    </script>
@endsection
