<!DOCTYPE html>
<html lang="en">

<head>
    @php
        use App\Models\Setting;

        $logo = Setting::where('key', 'logo')->first();
        $fevicon = Setting::where('key', 'fevicon')->first();
    @endphp
    <meta charset="utf-8" />
    <title>Admin-@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta content="{{ csrf_token() }}" name="csrf-token">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset($fevicon->value) }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset('admin/assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/styles/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/styles/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <style>
        label.required::after {
            content: "*";
            color: red;
            margin-left: 1px;
        }
    </style>
    @yield('css')
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">


        @include('admin.app.includes.sidebar')


        <!-- Topbar Start -->
        @include('admin.app.includes.header')
        <!-- Topbar End -->

        <!-- Search Modal -->
        @include('admin.app.includes.search-modal')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">

            <div class="page-container">

                {{-- Breadcrumb menu --}}
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-head d-flex align-items-center justify-content-between flex-wrap">
                            <!-- Page Title -->
                            <h4 class="fs-18 fw-semibold m-0">@yield('page-title')</h4>

                            <!-- Alerts -->
                            <div class="d-flex align-items-center">
                                <!-- Success Alert -->
                                @if (session('success'))
                                    <div id="success-alert"
                                        class="alert alert-success alert-dismissible fade show me-3 mb-0"
                                        style="min-width: 300px;" role="alert">
                                        <strong>Success!</strong> {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <!-- Failure Alert -->
                                @if (session('failure'))
                                    <div id="failure-alert" class="alert alert-danger alert-dismissible fade show mb-0"
                                        style="min-width: 300px;" role="alert">
                                        <strong>Error!</strong> {{ session('failure') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                        </div><!-- end page-title-head -->
                    </div>
                </div>



                {{-- breadcrumb menu end --}}

                @yield('content')
            </div>
            <!-- container -->


            @include('admin.app.includes.footer')

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->



    <!-- Vendor js -->
    <script src="{{ asset('admin/assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>

    <!-- Charts js -->
    <script src="{{ asset('admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Analytics Dashboard App js -->

    {{-- <script src="{{ asset('assets/js/pages/dashboard-clinic.js') }}"></script> --}}


    <script src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>
 
    {{-- alerts for 4 seconds only --}}
    <script>
        // Automatically dismiss alerts after 4 seconds
        setTimeout(() => {
            const successAlert = document.getElementById('success-alert');
            const failureAlert = document.getElementById('failure-alert');
            if (successAlert) successAlert.classList.remove('show');
            if (failureAlert) failureAlert.classList.remove('show');
        }, 4000);
    </script>


    @yield('javascripts')
</body>

</html>
