@extends('layouts.admin')

@section('title', 'Campaigns')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Campaigns</h4>
                <a href="{{ route('admin.campaigns.create') }}" class="btn btn-primary">Add Campaign</a>
            </div>
            <div class="card-body">
                <div id="alert-container"></div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div id="table-container">
                    @include('admin.campaigns.partials.table')
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
                Are you sure you want to delete this campaign?
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
                showAlert('success', 'Campaign deleted successfully');
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

    // AJAX Pagination
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    function fetch_data(page) {
        $.ajax({
            url: "{{ route('admin.campaigns.index') }}?page=" + page,
            success: function(data) {
                $('#table-container').html(data);
                window.history.pushState("", "", "{{ route('admin.campaigns.index') }}?page=" + page);
            }
        });
    }
</script>
@endpush
