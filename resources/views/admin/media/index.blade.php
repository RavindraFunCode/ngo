@extends('layouts.admin')

@section('title', 'Media Library')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Media Library</h4>
                <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                    @csrf
                    <input type="file" name="file" class="form-control me-2" required>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="row">
                    @forelse($media as $item)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card h-100">
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
                                <form action="{{ route('admin.media.destroy', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
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
            </div>
        </div>
    </div>
</div>
@endsection
