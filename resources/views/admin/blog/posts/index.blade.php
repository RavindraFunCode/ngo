@extends('layouts.admin')

@section('title', 'Blog Posts')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Blog Posts</h4>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Add Post</a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title (Default)</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Published At</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->getTranslation(app()->getLocale())->title ?? $post->getTranslation('en')->title ?? 'N/A' }}</td>
                                <td>{{ $post->category->getTranslation(app()->getLocale())->name ?? 'N/A' }}</td>
                                <td>{{ $post->author->name }}</td>
                                <td>{{ $post->published_at ? $post->published_at->format('Y-m-d') : 'Draft' }}</td>
                                <td>
                                    @if($post->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('admin.blog.destroy', $post) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
