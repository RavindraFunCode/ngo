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
                                        <img src="{{ \Illuminate\Support\Str::startsWith($feature->image, 'website/') ? asset($feature->image) : asset('uploads/' . $feature->image) }}" alt="Feature Image" width="50">
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
                    <div class="mb-3 d-none">
                        <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                        <select class="form-control" id="type" name="type" required onchange="updateFormFields()">
                            <option value="welcome">Welcome Feature</option>
                            <option value="about_us">About Us</option>
                            <option value="counter">Counter</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="subtitle" class="form-label" id="subtitleLabel">Subtitle</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle">
                    </div>
                    <div class="mb-3" id="descriptionGroup">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this feature?
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
    const assetUrl = "{{ asset('') }}";
    let deleteFeatureId = null;

    function resetForm() {
        $('#featureForm')[0].reset();
        $('#featureId').val('');
        $('#type').val('welcome');
        $('#featureModalLabel').text('Add Feature');
        $('#imagePreview').html('');
        $('#modal-alert-container').html('');
        updateFormFields();
    }

    function updateFormFields() {
        const type = $('#type').val();
        if (type === 'counter') {
            $('#subtitleLabel').text('Count Value');
            $('#descriptionGroup').hide();
            $('#description').prop('required', false);
        } else {
            $('#subtitleLabel').text('Subtitle');
            $('#descriptionGroup').show();
            $('#description').prop('required', true);
        }
    }

    function editFeature(id) {
        resetForm();
        $('#featureModalLabel').text('Edit Feature');
        $.get("{{ route('admin.features.index') }}/" + id + "/edit", function(data) {
            $('#featureId').val(data.id);
            $('#type').val(data.type || 'welcome');
            updateFormFields();
            $('#title').val(data.title);
            $('#subtitle').val(data.subtitle);
            $('#description').val(data.description);
            $('#icon').val(data.icon);
            $('#order').val(data.order);
            $('#is_active').prop('checked', data.is_active);
            if (data.image) {
                let imgSrc = data.image.startsWith('website/') ? 
                             assetUrl + data.image : 
                             assetUrl + "uploads/" + data.image;
                $('#imagePreview').html('<img src="' + imgSrc + '" width="100">');
            }
            $('#featureModal').modal('show');
        });
    }

    function saveFeature() {
        var id = $('#featureId').val();
        var url = id ? "{{ route('admin.features.index') }}/" + id : "{{ route('admin.features.store') }}";
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
                location.reload(); 
            },
            error: function(xhr) {
                var errorHtml = '<div class="alert alert-danger"><ul>';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errorHtml += '<li>' + value + '</li>';
                    });
                } else {
                    errorHtml += '<li>' + (xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred. Please try again.') + '</li>';
                }
                errorHtml += '</ul></div>';
                $('#modal-alert-container').html(errorHtml);
            }
        });
    }

    function deleteFeature(id) {
        deleteFeatureId = id;
        $('#deleteModal').modal('show');
    }

    function confirmDelete() {
        if (!deleteFeatureId) return;

        $.ajax({
            url: "{{ route('admin.features.index') }}/" + deleteFeatureId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            success: function(response) {
                $('#deleteModal').modal('hide');
                $('#feature-' + deleteFeatureId).remove();
                showAlert('success', response.success);
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
