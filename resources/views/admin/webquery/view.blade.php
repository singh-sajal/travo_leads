<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Contact us query details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="card">
                <div class="row g-0">
                    <div class="col-4">
                        <div class="card-body border-end">
                            <ul class="list-unstyled mb-0 pt-2" id="candidate-list">
                                <li>
                                    <a href="javascript:void(0);" class="d-flex align-items-center py-2">
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-1 text-truncate">
                                                <span class="candidate-name"><i class="ri-user-line"></i> </span>
                                                <span> {{ $row->name ?? '' }} </span>
                                            </h5>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="d-flex align-items-center py-2">
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-1 text-truncate">
                                                <span class="candidate-name"><i class="ri-phone-line"></i> </span>
                                                <span> {{ $row->phone ?? '' }} </span>
                                            </h5>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="d-flex align-items-center py-2">
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-1 text-truncate">
                                                <span class="candidate-name"><i class="ri-map-pin-line"></i> </span>
                                                <span> {{ $row->location ?? '' }} </span>
                                            </h5>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="d-flex align-items-center py-2">
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-1 text-truncate">
                                                <span class="candidate-name"><i class="ri-mail-line"></i> </span>
                                                <span> {{ $row->email ?? '' }} </span>
                                            </h5>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="d-flex align-items-center py-2">
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-1 text-truncate"><span class="candidate-name">
                                                    <i class="ri-calendar-2-line" title="Created at"></i>
                                                </span>
                                                <span>
                                                    {{ $row->created_at->format('g:i A , d, F Y') }}
                                                </span>
                                            </h5>

                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="d-flex align-items-center py-2">

                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-1 text-truncate"><span class="candidate-name">
                                                    <i class="ri-calendar-2-line" title="Updated"></i>
                                                </span>
                                                <span>
                                                    {{ $row->updated_at->format('g:i A , d, F Y') }}
                                                </span>
                                            </h5>

                                        </div>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body border-end">
                            <ul class="list-unstyled mb-0 pt-2" id="candidate-list">

                                <li>
                                    <a href="javascript:void(0);" class="d-flex align-items-center py-2">
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-1 text-truncate">
                                                <span class="candidate-name">Subject: </span>
                                                <span> {{ $row->subject ?? '' }} </span>
                                            </h5>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="d-flex align-items-center py-2">
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-1 text-truncate">
                                                <span class="candidate-name mb-1">Description <br>
                                                    <div class="p-1 rounded" style="border: 1px solid rgb(231, 225, 225);">
                                                        {{ $row->description ?? '' }}
                                                    </div>
                                                </span>
                                            </h5>
                                        </div>

                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.webquery.change_status', $row->id) }}" method="POST" novalidate>
                    <div class="row mb-3">

                        <div class="col-4">
                            <label for="title" class="required form-label">Mark as read/unread</label>
                            <select name="type" class="form-control" required>
                                <option value="">Select Mark as ...</option>
                                <option value="unread" {{ ($row->status ?? '') == 'unread' ? 'selected' : '' }}>Unread</option>
                                <option value="read" {{ ($row->status ?? '') == 'read' ? 'selected' : '' }}>Read</option>
                            </select>
                            <span data-error="type" class="text-danger mt-2"></span>
                        </div>
                        <div class="col-8 mt-4">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
