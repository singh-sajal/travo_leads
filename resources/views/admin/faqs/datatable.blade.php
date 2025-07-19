@forelse ($faqs as $faq)
    <tr>
        <!-- Show FAQ Question with Link to Detail Page -->
        <td>
            <a href="{{ route('admin.faqs.show', $faq->uuid) }}">{{ $faq->question }}</a>
        </td>
        <td>{{ $faq->answer }}</td> <!-- Limit answer length for better UI -->
        <td>
            <button class="btn btn-{{ $faq->status ? 'success' : 'danger' }} btn-xs btn-pill toggle-faq"
                data-uuid="{{ $faq->uuid }}">
                <i class="ti {{ $faq->status ? 'ti-eye' : 'ti-eye-off' }} me-1"></i>
                <span class="status-text">{{ $faq->status ? 'Active' : 'Inactive' }}</span>
            </button>
        </td>
        <td>{{ $faq->created_at->format('d-m-y') }}</td>
        <td>{{ $faq->updated_at->format('d-m-y') }}</td>
        <td>
            <!-- Action Buttons -->
            <div class="d-flex">
                <!-- Edit Button -->
                <a href="{{ route('admin.faqs.edit', $faq->uuid) }}" class="btn btn-success btn-icon btn-sm me-1">
                    <i class="ti ti-edit fs-16"></i>
                </a>

                <!-- Delete Button -->
                <form action="{{ route('admin.faqs.destroy', $faq->uuid) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-icon btn-sm">
                        <i class="ti ti-trash"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
@empty
    <!-- No Data Row -->
    <tr>
        <td colspan="6" class="text-center">No data Available</td>
    </tr>
@endforelse
