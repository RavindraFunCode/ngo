<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr id="row-{{ $event->id }}">
                <td>{{ $event->title ?? 'N/A' }}</td>
                <td>{{ $event->start_date ? $event->start_date->format('d M Y') : 'N/A' }}</td>
                <td>{{ $event->start_time ?? 'N/A' }}</td>
                <td>
                    <span class="badge bg-{{ $event->status == 'published' ? 'success' : 'secondary' }}">
                        {{ ucfirst($event->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-info">Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteItem('{{ route('admin.events.destroy', $event) }}', {{ $event->id }})">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-3">
    {{ $events->links() }}
</div>
