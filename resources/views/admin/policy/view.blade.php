<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Language Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="card">
                <div class="row g-0">
                    <div class="col-12">
                        <div class="card-body border-end">
                            <ul class="list-unstyled mb-0 pt-2" id="candidate-list">
                                <li>
                                    <a href="javascript:void(0);" class="d-flex align-items-center py-2">
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-1 text-truncate">
                                                <span class="candidate-name">Language Name: </span>
                                                <span><b> {{ $row->name }}</b> </span>
                                            </h5>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="d-flex align-items-center py-2">
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-1 text-truncate"><span class="candidate-name">Created on
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
                                            <h5 class="fs-13 mb-1 text-truncate"><span class="candidate-name">Last
                                                    Updated
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
                </div>
            </div>

        </div>

    </div>
</div>
