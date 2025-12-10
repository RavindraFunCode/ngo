@extends('layouts.admin')

@section('title', 'Team Members')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Team Members</h4>
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#teamModal" onclick="resetForm()">Add Member</button>
            </div>
            <div class="card-body">
                <div id="alert-container"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="teamTable">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $member)
                            <tr id="member-{{ $member->id }}">
                                <td>
                                    @if($member->image)
                                        <img src="{{ asset('uploads/' . $member->image) }}" alt="Team Image" width="50">
                                    @endif
                                </td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->role }}</td>
                                <td>{{ $member->order }}</td>
                                <td>
                                    @if($member->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editMember({{ $member->id }})">Edit</button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteMember({{ $member->id }})">Delete</button>
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

<!-- Team Modal -->
<div class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="teamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="teamModalLabel">Add Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-alert-container"></div>
                <form id="teamForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="memberId" name="id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" maxlength="255" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="role" name="role" maxlength="255" required>
                    </div>
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
                <button type="button" class="btn btn-primary" onclick="saveMember()">Save changes</button>
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
                Are you sure you want to delete this member?
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
    let deleteMemberId = null;

    function resetForm() {
        $('#teamForm')[0].reset();
        $('#memberId').val('');
        $('#teamModalLabel').text('Add Member');
        $('#imagePreview').html('');
        $('#modal-alert-container').html('');
        $('#image').attr('required', true);
    }

    function editMember(id) {
        resetForm();
        $('#teamModalLabel').text('Edit Member');
        $('#image').removeAttr('required');
        $.get('/admin/team/' + id + '/edit', function(data) {
            $('#memberId').val(data.id);
            $('#name').val(data.name);
            $('#role').val(data.role);
            $('#order').val(data.order);
            $('#is_active').prop('checked', data.is_active);
            if (data.image) {
                $('#imagePreview').html('<img src="/uploads/' + data.image + '" width="100">');
            }
            $('#teamModal').modal('show');
        });
    }

    function saveMember() {
        var id = $('#memberId').val();
        var url = id ? '/admin/team/' + id : '/admin/team';
        var formData = new FormData($('#teamForm')[0]);
        
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
                $('#teamModal').modal('hide');
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

    function deleteMember(id) {
        deleteMemberId = id;
        $('#deleteModal').modal('show');
    }

    function confirmDelete() {
        if (!deleteMemberId) return;
        
        $.ajax({
            url: '/admin/team/' + deleteMemberId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            success: function(response) {
                $('#deleteModal').modal('hide');
                $('#member-' + deleteMemberId).remove();
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
