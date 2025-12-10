@extends('layouts.admin')

@section('title', 'Sliders')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sliders</h4>
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#sliderModal" onclick="resetForm()">Add Slider</button>
            </div>
            <div class="card-body">
                <div id="alert-container"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="slidersTable">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $slider)
                            <tr id="slider-{{ $slider->id }}">
                                <td>
                                    @if($slider->image)
                                        <img src="{{ asset('uploads/' . $slider->image) }}" alt="Slider Image" width="100">
                                    @endif
                                </td>
                                <td>{{ $slider->order }}</td>
                                <td>
                                    @if($slider->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editSlider({{ $slider->id }})">Edit</button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteSlider({{ $slider->id }})">Delete</button>
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

<!-- Slider Modal -->
<div class="modal fade" id="sliderModal" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sliderModalLabel">Add Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-alert-container"></div>
                <form id="sliderForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="sliderId" name="id">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="image" name="image">
                        <div id="imagePreview" class="mt-2"></div>
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
                <button type="button" class="btn btn-primary" onclick="saveSlider()">Save changes</button>
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
                Are you sure you want to delete this slider?
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
    let deleteSliderId = null;

    function resetForm() {
        $('#sliderForm')[0].reset();
        $('#sliderId').val('');
        $('#sliderModalLabel').text('Add Slider');
        $('#imagePreview').html('');
        $('#modal-alert-container').html('');
    }

    function editSlider(id) {
        resetForm();
        $('#sliderModalLabel').text('Edit Slider');
        $.get('/admin/sliders/' + id + '/edit', function(data) {
            $('#sliderId').val(data.id);
            $('#order').val(data.order);
            $('#is_active').prop('checked', data.is_active);
            if (data.image) {
                $('#imagePreview').html('<img src="/uploads/' + data.image + '" width="100">');
            }
            $('#sliderModal').modal('show');
        });
    }

    function saveSlider() {
        var id = $('#sliderId').val();
        var url = id ? '/admin/sliders/' + id : '/admin/sliders';
        var formData = new FormData($('#sliderForm')[0]);
        
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
                $('#sliderModal').modal('hide');
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

    function deleteSlider(id) {
        deleteSliderId = id;
        $('#deleteModal').modal('show');
    }

    function confirmDelete() {
        if (!deleteSliderId) return;

        $.ajax({
            url: '/admin/sliders/' + deleteSliderId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            success: function(response) {
                $('#deleteModal').modal('hide');
                $('#slider-' + deleteSliderId).remove();
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
