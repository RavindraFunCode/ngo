<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name (Default)</th>
                <th>FAQs Count</th>
                <th>Active</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr id="row-{{ $category->id }}">
                <td>{{ $category->getTranslation(app()->getLocale())->name ?? $category->getTranslation('en')->name ?? 'N/A' }}</td>
                <td>{{ $category->faqs_count }}</td>
                <td>
                    <span class="badge bg-{{ $category->is_active ? 'success' : 'secondary' }}">
                        {{ $category->is_active ? 'Yes' : 'No' }}
                    </span>
                </td>
                <td>{{ $category->order }}</td>
                <td>
                    <a href="{{ route('admin.faq-categories.edit', $category) }}" class="btn btn-sm btn-info">Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteItem('{{ route('admin.faq-categories.destroy', $category) }}', {{ $category->id }})">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-3">
    {{ $categories->links() }}
</div>
