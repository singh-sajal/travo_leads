@extends('admin.app.app')
@section('title', 'Banners')
@section('page-title', 'Banners')
@section('css')

@endsection

@section('content')
    <div class="row">
        <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Banner Details Card -->
            <div class="col-12 mb-2">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h3 class="card-title pb-3 mb-4 border-bottom border-2 border-dashed text-primary">
                            New Banner form
                        </h3>
                        <div class="row mb-3">
                            <!-- Banner -->
                            <div class="col">
                                <label for="listingBanner" class="form-label text-secondary required">Banner</label>
                                <input type="file" id="listingBanner" name="banner" class="form-control" required>
                                @error('banner')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Submit and Cancel Buttons -->
            <div class="col-12 d-flex justify-content-end mb-3">
                <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Listing</button>
            </div>
        </form>
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
@endsection
