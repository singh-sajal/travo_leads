<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add New Course Language</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{ route('admin.policy.store') }}" novalidate enctype="multipart/form-data" method="POST">
            @csrf
            @include('admin.policy.form')
        </form>
    </div>

</div>
