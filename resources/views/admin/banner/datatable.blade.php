@forelse ($banners as $banner)
    <tr>
        <td><img class="avatar avatar-sm rounded-circle border border-2 border-primary me-3" src="{{ asset($testimonial->avatar) }}" alt=""></td>
        <td>{{ $banner->name }}</td>
        <td>{{ $banner->designation }}</td>
        <td>{{ $banner->created_at->format('d-m-y') }}</td>
        <td>{{ $banner->updated_at->format('d-m-y') }}</td>
        <td class="">
            <div class="d-flex">
                <a href="{{ route('admin.testimonial.show', $banner->uuid) }}" class="btn btn-primary btn-icon btn-sm me-1"> <i class="ti ti-eye"></i></a>
                <a href="{{ route('admin.testimonial.edit', $banner->uuid) }}" class="btn btn-success btn-icon btn-sm me-1"> <i class="ti ti-edit fs-16"></i></a>
                <form action="{{ route('admin.testimonial.destroy', $banner->uuid) }}" method="POST">
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


