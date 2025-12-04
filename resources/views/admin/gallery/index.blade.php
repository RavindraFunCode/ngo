@extends('layouts.admin')

@section('title', 'Gallery')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Gallery</h4>
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#galleryModal" onclick="resetForm()">Add Item</button>
            </div>
            <div class="card-body">
                <div id="alert-container"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="galleryTable">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr id="item-{{ $item->id }}">
                                <td>
                                    @if($item->image)
                                        <img src="{{ asset('uploads/' . $item->image) }}" alt="Gallery Image" width="100">
                                    @endif
                                </td>
                                <td>{{ $item->category }}</td>
                                <td>
                                    @if($item->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editItem({{ $item->id }})">Edit</button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteItem({{ $item->id }})">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galleryModalLabel">Add Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-alert-container"></div>
                <form id="galleryForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="itemId" name="id">
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="Education">Education</option>
                            <option value="Health">Health</option>
                            <option value="Environment">Environment</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <div id="imagePreview" class="mt-2"></div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveItem()">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function resetForm() {
        $('#galleryForm')[0].reset();
        $('#itemId').val('');
        $('#galleryModalLabel').text('Add Item');
        $('#imagePreview').html('');
        $('#modal-alert-container').html('');
    }

    function editItem(id) {
        resetForm();
        $('#galleryModalLabel').text('Edit Item');
        $.get('/admin/gallery/' + id + '/edit', function(data) {
            $('#itemId').val(data.id);
            $('#category').val(data.category);
            $('#is_active').prop('checked', data.is_active);
            if (data.image) {
                $('#imagePreview').html('<img src="/uploads/' + data.image + '" width="100">');
            }
            $('#galleryModal').modal('show');
        });
    }

    function saveItem() {
        var id = $('#itemId').val();
        var url = id ? '/admin/gallery/' + id : '/admin/gallery';
        var formData = new FormData($('#galleryForm')[0]);
        
        if (id) {
            formData.append('_method', 'PUT');
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#galleryModal').modal('hide');
                showAlert('success', response.success);
                location.reload(); 
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorHtml = '<div class="alert alert-danger"><ul>';
                $.each(errors, function(key, value) {
                    errorHtml += '<li>' + value + '</li>';
                });
                errorHtml += '</ul></div>';
                $('#modal-alert-container').html(errorHtml);
            }
        });
    }

    function deleteItem(id) {
        if (confirm('Are you sure?')) {
            $.ajax({
                url: '/admin/gallery/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#item-' + id).remove();
                    showAlert('success', response.success);
                }
            });
        }
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
