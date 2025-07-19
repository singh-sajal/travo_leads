@extends('admin.app.app')
@section('title', 'Company Policy')
@section('page-title', 'Policy List')
@section('breducrumb')
    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
    <li class="breadcrumb-item active"><a href="javascript: void(0);">Company Policy List</a></li>
@endsection
@section('css')

@endsection
@section('content')
    <div class="modal fade" data-bs-backdrop="static" id="AjaxModal" aria-hidden="true">
    </div>
    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title flex-grow-1 mb-0">All Policy List</h5>
                    <div>
                        <button class="btn btn-sm btn-primary actionHandler"
                            data-url="{{ route('admin.policy.create') }}">Add New</button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="DataTable" class="display table-bordered table basic" style="width:100%">
                        <thead>
                            <th>Index</th>
                            <th>Key</th>
                            <th>Description</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-customs nav-danger mb-3" role="tablist">
                        @foreach ($policies as $policy)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->index==0 ? 'active' : '' }}" data-bs-toggle="tab"
                                href="#border-navs-{{ $policy->key }}" role="tab"> {{ Str::ucfirst($policy->key) }}
                            </a>
                        </li>
                        @endforeach
                        {{-- <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#border-navs-home" role="tab">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#border-navs-profile" role="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#border-navs-messages" role="tab">Messages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#border-navs-settings" role="tab">Settings</a>
                        </li> --}}
                    </ul><!-- Tab panes -->
                    <div class="tab-content text-muted">
                        @foreach ($policies as $policy)
                        <div class="tab-pane {{ $loop->index==0 ? 'active' : '' }}" id="border-navs-{{ $policy->key }}" role="tabpanel">
                            <div class="btn-group" id="socialactions" role="group">
                                <button  data-url="{{ route('admin.policy.edit', $policy->id) }}"
                                    class="btn btn-primary btn-sm actionHandler"  type="button" >
                                        <i class="ri-edit-box-line"> Edit</i>
                                </button>
                            </div>
                            <div class="p-3" style="border: 1px #f2f2f2 solid;">
                                <span>
                                    {!! $policy->description !!}
                                </span>
                            </div>
                        </div>
                        @endforeach
                        {{-- <div class="tab-pane active" id="border-navs-home" role="tabpanel">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="ri-checkbox-circle-fill text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    Raw denim you probably haven't heard of them jean shorts Austin.
                                    Nesciunt tofu stumptown aliqua, retro synth master cleanse.
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <div class="flex-shrink-0">
                                    <i class="ri-checkbox-circle-fill text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    Too much or too little spacing, as in the example below, can make things unpleasant for the
                                    reader. The
                                    goal is to make your text as comfortable to read as possible.
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="border-navs-profile" role="tabpanel">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="ri-checkbox-circle-fill text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    In some designs, you might adjust your tracking to create a certain artistic effect. It can
                                    also help
                                    you fix fonts that are poorly spaced to begin with.
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <div class="flex-shrink-0">
                                    <i class="ri-checkbox-circle-fill text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    A wonderful serenity has taken possession of my entire soul, like these sweet mornings of
                                    spring which I
                                    enjoy with my whole heart.
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="border-navs-messages" role="tabpanel">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="ri-checkbox-circle-fill text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    Each design is a new, unique piece of art birthed into this world, and while you have the
                                    opportunity to
                                    be creative and make your own style choices.
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <div class="flex-shrink-0">
                                    <i class="ri-checkbox-circle-fill text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    For that very reason, I went on a quest and spoke to many different professional graphic
                                    designers and
                                    asked them what graphic design tips they live.
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="border-navs-settings" role="tabpanel">
                            <div class="d-flex mt-2">
                                <div class="flex-shrink-0">
                                    <i class="ri-checkbox-circle-fill text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    For that very reason, I went on a quest and spoke to many different professional graphic
                                    designers and
                                    asked them what graphic design tips they live.
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <div class="flex-shrink-0">
                                    <i class="ri-checkbox-circle-fill text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    After gathering lots of different opinions and graphic design basics, I came up with a list
                                    of 30
                                    graphic design tips that you can start implementing.
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div><!-- end card-body -->
            </div>
        </div>
        <!--end col-->
    </div>
@endsection

@section('javascripts')
    {{-- @php
        $url = route('admin.policy.index');
        $columns = [
            //
            ['DT_RowIndex'],
            ['key', 's', 'o'],
            ['description', 's', 'o'],
            ['updated_at', 's', 'o'],
        ];
        // Available Options
        // $options = ['showRefreshButton', 'reorderColumn', 'noSearching', 'showSearchBuilder', 'noActions'];
        $options = ['showRefreshButton'];
    @endphp --}}
    {{-- @include('admin.app.datatable', compact('url', 'columns', 'options')); --}}
@endsection
