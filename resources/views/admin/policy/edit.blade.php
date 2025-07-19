<div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Update Course Language</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{ route('admin.policy.update', $row->id) }}"
                  enctype="multipart/form-data" method="POST">
            @method('put')
            @csrf
            @include('admin.policy.form')
        </form>
    </div>
</div>
