<div class="modal-dialog .modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> Update Setting</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{ route('admin.settings.update', [$setting->id, 'type'=> $type]) }}"
                  enctype="multipart/form-data" method="POST" novalidate data-error-style="default">
            @method('put')
            @csrf
            @include('admin.settings.form')
        </form>
    </div>
</div>
