@extends('admin.app')
@section('title', 'Web Query')
@section('page-title', 'Web Query')
@section('breducrumb')
    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
    <li class="breadcrumb-item active"><a href="javascript: void(0);">Web Query</a></li>
@endsection
@section('css')

@endsection
@section('content')
    <div class="modal fade" data-bs-backdrop="static" id="AjaxModal" aria-hidden="true">
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title flex-grow-1 mb-0">Web Query</h5>

                </div>
                <div class="card-body">
                    <table id="DataTable" class="display table-bordered table basic" style="width:100%">
                        <thead>
                            <th>Index</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>location</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @php
        $url = route('admin.webquery.index');
        $columns = [
            //
            ['DT_RowIndex'],
            ['name', 's', 'o'],
            ['email', 's', 'o'],
            ['phone', 's', 'o'],
            ['subject', 's', 'o'],
            ['location', 's', 'o'],
            ['created_at', 's', 'o'],
        ];
        // Available Options
        // $options = ['showRefreshButton', 'reorderColumn', 'noSearching', 'showSearchBuilder', 'noActions'];
        $options = ['showRefreshButton'];
    @endphp
    @include('admin.app.datatable', compact('url', 'columns', 'options'));
@endsection
