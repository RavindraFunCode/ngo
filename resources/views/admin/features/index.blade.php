@extends('layouts.admin')

@section('title', 'Features')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Features</h4>
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#featureModal" onclick="resetForm()">Add Feature</button>
            </div>
            <div class="card-body">
                <div id="alert-container"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="featuresTable">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($features as $feature)
                            <tr id="feature-{{ $feature->id }}">
                                <td>
                                    @if($feature->image)
                                        <img src="{{ asset('uploads/' . $feature->image) }}" alt="Feature Image" width="50">
                                    @endif
                                </td>
                                <td>{{ $feature->title }}</td>
                                <td>{{ $feature->subtitle }}</td>
                                <td>{{ $feature->order }}</td>
                                <td>
                                    @if($feature->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editFeature({{ $feature->id }})">Edit</button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteFeature({{ $feature->id }})">Delete</button>
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

<!-- Feature Modal -->
<div class="modal fade" id="featureModal" tabindex="-1" aria-labelledby="featureModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="featureModalLabel">Add Feature</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-alert-container"></div>
                <form id="featureForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="featureId" name="id">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Subtitle</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <div id="imagePreview" class="mt-2"></div>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon Class (e.g., icon-people)</label>
                        <input type="text" class="form-control" id="icon" name="icon">
                    </div>
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="0">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveFeature()">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function resetForm() {
        $('#featureForm')[0].reset();
        $('#featureId').val('');
        $('#featureModalLabel').text('Add Feature');
        $('#imagePreview').html('');
        $('#modal-alert-container').html('');
    }

    function editFeature(id) {
        resetForm();
        $('#featureModalLabel').text('Edit Feature');
        $.get('/admin/features/' + id + '/edit', function(data) {
            $('#featureId').val(data.id);
            $('#title').val(data.title);
            $('#subtitle').val(data.subtitle);
            $('#description').val(data.description);
            $('#icon').val(data.icon);
            $('#order').val(data.order);
            $('#is_active').prop('checked', data.is_active);
            if (data.image) {
                $('#imagePreview').html('<img src="/uploads/' + data.image + '" width="100">');
            }
            $('#featureModal').modal('show');
        });
    }

    function saveFeature() {
        var id = $('#featureId').val();
        var url = id ? '/admin/features/' + id : '/admin/features';
        var method = id ? 'POST' : 'POST'; // Using POST for both, but adding _method for PUT
        var formData = new FormData($('#featureForm')[0]);
        
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
                $('#featureModal').modal('hide');
                showAlert('success', response.success);
                location.reload(); // Simple reload to refresh table. For full AJAX, we'd append/update row.
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

    function deleteFeature(id) {
        if (confirm('Are you sure?')) {
            $.ajax({
                url: '/admin/features/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#feature-' + id).remove();
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
