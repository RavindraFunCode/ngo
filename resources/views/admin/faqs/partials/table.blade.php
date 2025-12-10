<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Question (Default)</th>
                <th>Active</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faqs as $faq)
            <tr id="row-{{ $faq->id }}">
                <td>{{ $faq->getTranslation(app()->getLocale())->question ?? $faq->getTranslation('en')->question ?? 'N/A' }}</td>
                <td>
                    <span class="badge bg-{{ $faq->is_active ? 'success' : 'secondary' }}">
                        {{ $faq->is_active ? 'Yes' : 'No' }}
                    </span>
                </td>
                <td>{{ $faq->order }}</td>
                <td>
                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-info">Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteItem('{{ route('admin.faqs.destroy', $faq) }}', {{ $faq->id }})">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-3">
    {{ $faqs->links() }}
</div>
