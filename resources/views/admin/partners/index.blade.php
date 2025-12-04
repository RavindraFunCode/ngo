@extends('layouts.admin')

@section('title', 'Partners')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Partners</h4>
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#partnerModal" onclick="resetForm()">Add Partner</button>
            </div>
            <div class="card-body">
                <div id="alert-container"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="partnersTable">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Name</th>
                                <th>Order</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($partners as $partner)
                            <tr id="partner-{{ $partner->id }}">
                                <td>
                                    @if($partner->logo)
                                        <img src="{{ asset('uploads/' . $partner->logo) }}" alt="Partner Logo" width="100">
                                    @endif
                                </td>
                                <td>{{ $partner->name }}</td>
                                <td>{{ $partner->order }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editPartner({{ $partner->id }})">Edit</button>
                                    <button class="btn btn-sm btn-danger" onclick="deletePartner({{ $partner->id }})">Delete</button>
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

<!-- Partner Modal -->
<div class="modal fade" id="partnerModal" tabindex="-1" aria-labelledby="partnerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="partnerModalLabel">Add Partner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-alert-container"></div>
                <form id="partnerForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="partnerId" name="id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" class="form-control" id="logo" name="logo">
                        <div id="logoPreview" class="mt-2"></div>
                    </div>
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="0">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="savePartner()">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function resetForm() {
        $('#partnerForm')[0].reset();
        $('#partnerId').val('');
        $('#partnerModalLabel').text('Add Partner');
        $('#logoPreview').html('');
        $('#modal-alert-container').html('');
    }

    function editPartner(id) {
        resetForm();
        $('#partnerModalLabel').text('Edit Partner');
        $.get('/admin/partners/' + id + '/edit', function(data) {
            $('#partnerId').val(data.id);
            $('#name').val(data.name);
            $('#order').val(data.order);
            if (data.logo) {
                $('#logoPreview').html('<img src="/uploads/' + data.logo + '" width="100">');
            }
            $('#partnerModal').modal('show');
        });
    }

    function savePartner() {
        var id = $('#partnerId').val();
        var url = id ? '/admin/partners/' + id : '/admin/partners';
        var formData = new FormData($('#partnerForm')[0]);
        
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
                $('#partnerModal').modal('hide');
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

    function deletePartner(id) {
        if (confirm('Are you sure?')) {
            $.ajax({
                url: '/admin/partners/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#partner-' + id).remove();
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
