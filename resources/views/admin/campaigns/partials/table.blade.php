<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title (Default)</th>
                <th>Target</th>
                <th>Raised</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($campaigns as $campaign)
            <tr id="row-{{ $campaign->id }}">
                <td>{{ $campaign->getTranslation(app()->getLocale())->title ?? $campaign->getTranslation('en')->title ?? 'N/A' }}</td>
                <td>{{ $campaign->currency }} {{ number_format($campaign->target_amount, 2) }}</td>
                <td>{{ $campaign->currency }} {{ number_format($campaign->raised_amount, 2) }}</td>
                <td>
                    <span class="badge bg-{{ $campaign->status == 'published' ? 'success' : ($campaign->status == 'draft' ? 'secondary' : 'warning') }}">
                        {{ ucfirst($campaign->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.campaigns.show', $campaign) }}" class="btn btn-sm btn-success">View</a>
                    <a href="{{ route('admin.campaigns.edit', $campaign) }}" class="btn btn-sm btn-info">Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteItem('{{ route('admin.campaigns.destroy', $campaign) }}', {{ $campaign->id }})">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-3">
    {{ $campaigns->links() }}
</div>
