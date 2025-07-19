@forelse ($queries as $query)
    <tr>
        <td>{{ $query->name }}</td>
        <td>{{ $query->email }}</td>
        <td>{{ $query->phone }}</td>
        <td>{{ $query->package_name }}</td>
        <td>{{ $query->created_at->format('d-m-y') }}</td>
        <td>
            <div>
                <form action="{{ route('admin.query.destroy', $query->uuid) }}" method="POST">
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
