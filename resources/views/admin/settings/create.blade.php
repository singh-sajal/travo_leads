<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add New Setting</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        @if ($request->has('type'))
            @if (!empty($request->type))
                <form action="{{ route('admin.settings.store',['type'=>$request->type]) }}" novalidate enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    @include('admin.settings.form')
                </form>
            @endif
        @endif
    </div>

</div>
