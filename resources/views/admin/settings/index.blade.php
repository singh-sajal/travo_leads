@extends('admin.app.app')
@section('title', 'Setting: Global Settings')
@section('page-title', 'Global Settings')
@section('breducrumb')
    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
    <li class="breadcrumb-item active"><a href="javascript: void(0);">Global Settings</a></li>
@endsection
@section('css')

@endsection
@section('content')
    @php
        $color = ['primary', 'success', 'danger', 'warning', 'info'];
        $contact_icon = ['phone', 'mail', 'map-pin', 'map-pin', 'phone'];
    @endphp
    <div class="modal fade" data-bs-backdrop="static" id="AjaxModal" aria-hidden="true">
    </div>

    <div class="row pt-5 mt-3">
        <div class="col-3">
            <div class="card mt-n5">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title flex-grow-1 mb-0">Logo</h5>
                    {{-- <div>
                        <button class="btn btn-sm btn-primary actionHandler"
                            data-url="{{ route('admin.document_category.create') }}">Add New</button>
                    </div> --}}
                </div>
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-1">
                            <img src="{{ asset($logo->value ?? 'uploads/no_img_icon.jpg') }}" style="height: 30%;"
                                class="avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                <button data-url="{{ route('admin.settings.edit', $logo->id) }}"
                                    class="btn btn-primary rounded-circle btn-sm actionHandler" type="button">
                                    <i class="ri-edit-box-line"></i></button>
                            </div>
                        </div>
                        {{-- <h5 class="fs-16 mb-1">Anna Adame</h5>
                        <p class="text-muted mb-0">Lead Designer / Developer</p> --}}
                    </div>
                </div>
            </div>
            <!--end card-->
            <div class="card mt-n3">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title flex-grow-1 mb-1">Fevicon Icon</h5>
                    {{-- <div>
                        <button class="btn btn-sm btn-primary actionHandler"
                            data-url="{{ route('admin.document_category.create') }}">Add New</button>
                    </div> --}}
                </div>
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto mb-1">
                            <img src="{{ asset($fevicon->value ?? 'uploads/no_img_icon.jpg') }}"
                                class="img-thumbnail user-profile-image" alt="user-profile-image">
                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                <button data-url="{{ route('admin.settings.edit', $fevicon->id) }}"
                                    class="btn btn-primary rounded-circle btn-sm actionHandler" type="button">
                                    <i class="ri-edit-box-line"></i>
                                </button>
                            </div>
                        </div>
                        {{-- <h5 class="fs-16 mb-1">Anna Adame</h5>
                        <p class="text-muted mb-0">Lead Designer / Developer</p> --}}
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-4">
            <div class="card mt-n5">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Contact Details</h5>
                        </div>
                    </div>
                    @foreach ($contacts as $contact)
                        <div class="d-flex align-items-center py-2">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span class="avatar-title rounded-circle fs-16 bg-{{ $color[$loop->index] }} text-light">
                                    <i class="ri-{{ $contact_icon[$loop->index] }}-fill"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <div>
                                    <h5 class="fs-15 mb-1">{{ $contact->key ?? '' }}</h5>
                                    @if ($contact->key == 'map')
                                        <a href="{{ route('admin.settings.show', $contact->id) }}" target="_blank">Visit</a>
                                    @else
                                        <p class="text-muted mb-0">{{ $contact->value ?? '' }}</p>
                                    @endif

                                </div>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                {{-- <button type="button" class="btn btn-sm btn-outline-info">
                                    <i class="ri-user-add-line align-middle"></i></button> --}}
                                <button data-url="{{ route('admin.settings.edit', $contact->id) }}"
                                    class="btn btn-primary btn-sm actionHandler" type="button">
                                    <i class="ri-edit-box-line"></i></button>

                            </div>
                        </div>
                    @endforeach
                    @if (!empty($map))
                        <div class="d-flex align-items-center py-2">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span class="avatar-title rounded-circle fs-16 bg-info text-light">
                                    <i class="ri-map-pin-fill"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <div>
                                    <h5 class="fs-15 mb-1">{{ $map->key ?? '' }}</h5>
                                    <a href="{{ route('admin.settings.show', [$map->id, 'type' => 'map']) }}"
                                        target="_blank">
                                        <span class="badge bg-success">Visit</span>
                                    </a>
                                </div>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                {{-- <button type="button" class="btn btn-sm btn-outline-info">
                                <i class="ri-user-add-line align-middle"></i></button> --}}
                                <button data-url="{{ route('admin.settings.edit', [$map->id, 'type' => 'map']) }}"
                                    class="btn btn-primary btn-sm actionHandler" type="button">
                                    <i class="ri-edit-box-line"></i></button>

                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-5">
            <div class="card mt-n5">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-0">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Social Links</h5>
                        </div>
                        {{-- <div class="flex-shrink-0"> --}}
                            {{-- <a href="javascript:void(0);" class="badge bg-light text-primary fs-12"><i
                                    class="ri-add-fill align-bottom me-1"></i> Add</a> --}}
                            {{-- <button class="btn btn-sm btn-primary actionHandler" type="button"
                                data-url="{{ route('admin.settings.create', ['type' => 'social_link']) }}">Add New</button>
                        </div> --}}
                    </div>
                    @foreach ($social_links as $social_link)
                        <div class="d-flex align-items-center py-2">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span
                                    class="avatar-title rounded-circle fs-16 bg-{{ $color[$loop->index % 4] }} text-light">
                                    <i
                                        class="ri-{{ $social_link->key == 'twitter' ? 'twitter-x' : $social_link->key }}-fill"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <div>
                                    <h5 class="fs-15 mb-1">{{ $social_link->key ?? '' }}</h5>
                                    <a href="{{ $social_link->value ?? '' }}"
                                        target="_blank">{{ $social_link->value ?? '' }}</a>
                                </div>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <button data-url="{{ route('admin.settings.edit', $social_link->id) }}"
                                    class="btn btn-primary btn-sm actionHandler" type="button">
                                    <i class="ri-edit-box-line"></i></button>

                                <button data-action="delete"
                                    data-url="{{ route('admin.settings.destroy', $social_link->id) }}"
                                    class="btn btn-danger btn-sm actionHandler" type="button">
                                    <i class="ri-delete-bin-line"></i></button>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>

    <div class="row pt-5 mt-3 justify-content-center">
        <div class="col-8">
            <div class="card mt-n5">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title flex-grow-1 mb-0">Home Video</h5>
                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                        <button data-url="{{ route('admin.settings.edit', $home_video->id) }}"
                            class="btn btn-primary rounded-circle btn-sm actionHandler" type="button">
                            <i class="ri-edit-box-line"></i></button>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-1">
                            @php
                                $video_id = '';
                                if ($home_video && $home_video->value) {
                                    // Extract video ID from YouTube URL
                                    preg_match(
                                        '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
                                        $home_video->value,
                                        $matches,
                                    );

                                    if (!empty($matches[1])) {
                                        $video_id = $matches[1];
                                    }
                                }
                            @endphp

                            @if ($video_id)
                                <iframe width="500px" height="300"
                                    src="https://www.youtube.com/embed/{{ $video_id }}" frameborder="0"
                                    allowfullscreen></iframe>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="row pt-5 mt-3">

        <div class="col-6">
            <div class="card mt-n5">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title flex-grow-1 mb-0">Customer App</h5>
                </div>
                @foreach ($mobile_app as $app)
                    <div class="d-flex align-items-center py-2 p-3">
                        {{-- <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span
                                    class="avatar-title rounded-circle fs-16 bg-{{ $color[$loop->index % 4] }} text-light">
                                    <i
                                        class="ri-{{ $social_link->key == 'twitter' ? 'twitter-x' : $social_link->key }}-fill"></i>
                                </span>
                            </div> --}}
                        <div class="flex-grow-1">
                            <div>
                                <h5 class="fs-15 mb-1">{{ $app->key ?? '' }}</h5>
                                <a href="{{ $app->value ?? '' }}" target="_blank">{{ $app->value ?? '' }}</a>
                            </div>
                        </div>
                        <div class="flex-shrink-0 ms-2">

                            <button data-url="{{ route('admin.settings.edit', $app->id) }}"
                                class="btn btn-primary btn-sm actionHandler" type="button">
                                <i class="ri-edit-box-line"></i></button>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="col-6">
            <div class="card mt-n5">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title flex-grow-1 mb-0">Delivery App</h5>
                </div>

                <div class="d-flex align-items-center py-2 p-3">

                    <div class="flex-grow-1">
                        <div>
                            <h5 class="fs-15 mb-1">{{ $del_app->key ?? '' }}</h5>
                            <a href="{{ $del_app->value ?? '' }}" target="_blank">{{ $del_app->value ?? '' }}</a>
                        </div>
                    </div>
                    <div class="flex-shrink-0 ms-2">

                        <button data-url="{{ route('admin.settings.edit', $del_app->id) }}"
                            class="btn btn-primary btn-sm actionHandler" type="button">
                            <i class="ri-edit-box-line"></i></button>

                    </div>
                </div>

            </div>

        </div>
        <!--end col-->
    </div>
@endsection

@section('javascripts')
<script src="{{ asset('admin/assets/js/ajax-engine-1.0.js') }}"></script>
@endsection
