<!-- Sidenav Menu Start -->
<div class="sidenav-menu">

    <!-- Brand Logo -->
    <a href="#" class="logo">
        <span class="logo-light">
            <span class="logo-lg"><img src="{{ asset('admin\assets\images\logo.png') }}" alt="logo"></span>
            <span class="logo-sm"><img src="{{ asset($fevicon->value) }}" alt="small logo"></span>
        </span>

        <span class="logo-dark">
            <span class="logo-lg"><img src="{{ asset($logo->value) }}" alt="dark logo"></span>
            <span class="logo-sm"><img src="{{ asset($fevicon->value) }}" alt="small logo"></span>
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-sm-hover">
        <i class="ti ti-circle align-middle"></i>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-fullsidebar">
        <i class="ti ti-x align-middle"></i>
    </button>

    <div data-simplebar>

        <!--- Sidenav Menu -->
        <ul class="side-nav">
            <li class="side-nav-title">Dash</li>

            {{-- Dashboard --}}
            <li class="side-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                    <span class="menu-text">Dashboard </span>
                </a>
            </li>
            {{-- Banner --}}
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarBanner" aria-expanded="false" aria-controls="sidebarBanner"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-medical-cross"></i></span>
                    <span class="menu-text"> Banner</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarBanner">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('admin.banner.index') }}" class="side-nav-link">
                                <span class="menu-text">List</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.banner.create') }}" class="side-nav-link">
                                <span class="menu-text">Add New Banner</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- Destination --}}
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarDestination" aria-expanded="false"
                    aria-controls="sidebarDestination" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-medical-cross"></i></span>
                    <span class="menu-text"> Destination</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarDestination">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('admin.destination.index') }}" class="side-nav-link">
                                <span class="menu-text">List</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.destination.create') }}" class="side-nav-link">
                                <span class="menu-text">Add New Destination</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- Packages List and add Packages --}}
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPackages" aria-expanded="false"
                    aria-controls="sidebarPackages" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-medical-cross"></i></span>
                    <span class="menu-text"> Packages</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPackages">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('admin.package.index') }}" class="side-nav-link">
                                <span class="menu-text">List</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.package.create') }}" class="side-nav-link">
                                <span class="menu-text">Add New Packages</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- Faqs --}}
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarFaqs" aria-expanded="false" aria-controls="sidebarFaqs"
                    class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-medical-cross"></i></span>
                    <span class="menu-text"> Faqs</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarFaqs">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('admin.faqs.index') }}" class="side-nav-link">
                                <span class="menu-text">List</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.faqs.create') }}" class="side-nav-link">
                                <span class="menu-text">Add New Query</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- Queries --}}
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarQueries" aria-expanded="false"
                    aria-controls="sidebarQueries" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-medical-cross"></i></span>
                    <span class="menu-text"> Queries</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarQueries">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('admin.query.index') }}" class="side-nav-link">
                                <span class="menu-text">List</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.query.create') }}" class="side-nav-link">
                                <span class="menu-text">Add New Query</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="side-nav-item">
                <a href="{{ route('admin.settings.index') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-building-hospital"></i></span>
                    <span class="menu-text"> Settngs </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('admin.auth.logout') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-building-hospital"></i></span>
                    <span class="menu-text"> Logout </span>
                </a>
            </li>
        </ul>

        {{-- <!-- Help Box -->
          <div class="help-box text-center">
              <img src="{{ asset('assets/images/coffee-cup.svg') }}" height="90" alt="Helper Icon Image" />
              <h5 class="mt-3 fw-semibold fs-16">Unlimited Access</h5>
              <p class="mb-3 text-muted">Upgrade to plan to get access to unlimited reports</p>
              <a href="javascript: void(0);" class="btn btn-danger btn-sm">Upgrade</a>
          </div> --}}

        <div class="clearfix"></div>
    </div>
</div>
<!-- Sidenav Menu End -->
