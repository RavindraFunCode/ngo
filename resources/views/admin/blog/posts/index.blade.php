@extends('layouts.admin')

@section('title', 'Blog Posts')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Blog Posts</h4>
                <a href="{{ route('admin.blog.posts.create') }}" class="btn btn-primary">Add Post</a>
            </div>
            <div class="card-body">
                <div id="alert-container"></div>
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
                            <tr id="row-{{ $post->id }}">
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
                                    <a href="{{ route('admin.blog.posts.edit', $post) }}" class="btn btn-sm btn-info">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteItem('{{ route('admin.blog.posts.destroy', $post) }}', {{ $post->id }})">Delete</button>
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this post?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let deleteUrl = null;
    let deleteRowId = null;

    function deleteItem(url, id) {
        deleteUrl = url;
        deleteRowId = id;
        $('#deleteModal').modal('show');
    }

    function confirmDelete() {
        if (!deleteUrl) return;

        $.ajax({
            url: deleteUrl,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            success: function(response) {
                $('#deleteModal').modal('hide');
                $('#row-' + deleteRowId).remove();
                showAlert('success', 'Post deleted successfully');
            },
            error: function(xhr) {
                $('#deleteModal').modal('hide');
                alert('Error: ' + (xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong.'));
            }
        });
    }

    function showAlert(type, message) {
        var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
            message +
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
            '</div>';
        $('#alert-container').html(alertHtml);
    }
</script>
@endpush
