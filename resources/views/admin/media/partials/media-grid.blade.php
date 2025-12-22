<div class="row">
    @forelse($media as $item)
    <div class="col-md-3 col-sm-6 mb-4 media-item" id="media-item-{{ $item->id }}">
        <div class="card h-100 position-relative">
            <div class="position-absolute top-0 start-0 p-2 z-index-1" style="z-index: 10;">
                <input type="checkbox" value="{{ $item->id }}" class="form-check-input media-checkbox" style="width: 1.2em; height: 1.2em; cursor: pointer;">
            </div>
            @if(Str::startsWith($item->mime_type, 'image/'))
                <img src="{{ Storage::url($item->path) }}" class="card-img-top" alt="{{ $item->alt_text }}" style="height: 150px; object-fit: cover;">
            @else
                <div class="card-body d-flex align-items-center justify-content-center bg-light" style="height: 150px;">
                    <iconify-icon icon="solar:file-bold-duotone" width="48"></iconify-icon>
                </div>
            @endif
            <div class="card-body p-2">
                <p class="card-text text-truncate" title="{{ $item->original_name }}">{{ $item->original_name }}</p>
                <small class="text-muted">{{ number_format($item->size / 1024, 2) }} KB</small>
            </div>
            <div class="card-footer p-2 bg-transparent border-top-0">
                <button type="button" class="btn btn-sm btn-danger w-100 btn-delete-media" data-id="{{ $item->id }}" data-url="{{ route('admin.media.destroy', $item) }}">Delete</button>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <p class="text-muted">No media files found.</p>
    </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $media->links() }}
</div>
