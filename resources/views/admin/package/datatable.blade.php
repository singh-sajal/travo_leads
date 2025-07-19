@forelse ($packages as $package)
    <tr>
        <td><img class="avatar avatar-sm rounded-circle border border-2 border-primary me-3"
                src="{{ asset($package->image) }}" alt=""></td>
        <td><a href="{{ route('admin.package.show', $package->uuid) }}">{{ $package->name }}</a></td>
        <td>{{ $package->destination->title }}</a></td>
        <td>₹ {{ $package->price }}</td>
        <td>{{ $package->duration_days }}D {{ $package->duration_nights }}N</td>
        <td>
            <button class="btn btn-{{ $package->status ? 'success' : 'danger' }} btn-xs btn-pill toggle-package"
                data-uuid="{{ $package->uuid }}">
                <i class="ti {{ $package->status ? 'ti-eye' : 'ti-eye-off' }} me-1"></i>
                <span class="status-text">{{ $package->status ? 'Active' : 'Inactive' }}</span>
            </button>
        </td>

        <!-- For Featured Toggle -->
        <td>
            <button class="btn btn-{{ $package->is_featured ? 'success' : 'danger' }} btn-xs btn-pill toggle-item"
                data-uuid="{{ $package->uuid }}" data-type="package" data-field="is_featured">
                <i class="ti {{ $package->is_featured ? 'ti-star' : 'ti-star-off' }} me-1"></i>
                <span class="status-text">{{ $package->is_featured ? 'Featured' : 'Not Featured' }}</span>
            </button>

        </td>
        <td>{{ $package->created_at->format('d-m-y') }}</td>
        <td>{{ $package->updated_at->format('d-m-y') }}</td>
        <td>
            <div class="d-flex">
                <a href="{{ route('admin.package.edit', $package->uuid) }}"
                    class="btn btn-success btn-icon btn-sm me-1"> <i class="ti ti-edit fs-16"></i></a>
                <form action="{{ route('admin.package.destroy', $package->uuid) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-icon btn-sm"><i class="ti ti-trash"></i></button>
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center">No data Available</td>
    </tr>
@endforelse
