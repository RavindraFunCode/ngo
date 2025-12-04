@extends('layouts.admin')

@section('title', 'Testimonials')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Testimonials</h4>
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#testimonialModal" onclick="resetForm()">Add Testimonial</button>
            </div>
            <div class="card-body">
                <div id="alert-container"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="testimonialsTable">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Content</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($testimonials as $testimonial)
                            <tr id="testimonial-{{ $testimonial->id }}">
                                <td>
                                    @if($testimonial->image)
                                        <img src="{{ asset('uploads/' . $testimonial->image) }}" alt="Testimonial Image" width="50">
                                    @endif
                                </td>
                                <td>{{ $testimonial->name }}</td>
                                <td>{{ Str::limit($testimonial->content, 50) }}</td>
                                <td>
                                    @if($testimonial->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editTestimonial({{ $testimonial->id }})">Edit</button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteTestimonial({{ $testimonial->id }})">Delete</button>
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

<!-- Testimonial Modal -->
<div class="modal fade" id="testimonialModal" tabindex="-1" aria-labelledby="testimonialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="testimonialModalLabel">Add Testimonial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-alert-container"></div>
                <form id="testimonialForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="testimonialId" name="id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
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
                <button type="button" class="btn btn-primary" onclick="saveTestimonial()">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function resetForm() {
        $('#testimonialForm')[0].reset();
        $('#testimonialId').val('');
        $('#testimonialModalLabel').text('Add Testimonial');
        $('#imagePreview').html('');
        $('#modal-alert-container').html('');
    }

    function editTestimonial(id) {
        resetForm();
        $('#testimonialModalLabel').text('Edit Testimonial');
        $.get('/admin/testimonials/' + id + '/edit', function(data) {
            $('#testimonialId').val(data.id);
            $('#name').val(data.name);
            $('#content').val(data.content);
            $('#is_active').prop('checked', data.is_active);
            if (data.image) {
                $('#imagePreview').html('<img src="/uploads/' + data.image + '" width="100">');
            }
            $('#testimonialModal').modal('show');
        });
    }

    function saveTestimonial() {
        var id = $('#testimonialId').val();
        var url = id ? '/admin/testimonials/' + id : '/admin/testimonials';
        var formData = new FormData($('#testimonialForm')[0]);
        
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
                $('#testimonialModal').modal('hide');
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

    function deleteTestimonial(id) {
        if (confirm('Are you sure?')) {
            $.ajax({
                url: '/admin/testimonials/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#testimonial-' + id).remove();
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
