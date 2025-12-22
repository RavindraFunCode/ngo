@extends('layouts.admin')

@section('title', 'Countries')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Countries</h4>
                <div class="d-flex gap-2">
                    <form action="{{ route('admin.countries.index') }}" method="GET" class="d-flex input-group input-group-sm" style="width: 250px;">
                        <input type="text" name="search" class="form-control" placeholder="Search by name..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-secondary"><i class="bx bx-search"></i></button>
                        @if(request()->has('search'))
                            <a href="{{ route('admin.countries.index') }}" class="btn btn-outline-danger" title="Clear Search"><i class="bx bx-x"></i></a>
                        @endif
                    </form>
                    <button type="button" class="btn btn-primary btn-sm" id="btn-add-country">Add New Country</button>
                </div>
            </div>
            <div class="card-body">
                <div id="alert-container"></div>

                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="countries-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>ISO Code</th>
                                <th>Phone Code</th>
                                <th>Currency</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($countries as $country)
                                <tr id="row-{{ $country->id }}">
                                    <td>{{ $country->name }}</td>
                                    <td>{{ $country->iso }}</td>
                                    <td>{{ $country->phonecode }}</td>
                                    <td>{{ $country->currency_code }} ({{ $country->currency_symbol }})</td>
                                    <td>
                                        @if($country->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info btn-edit" data-id="{{ $country->id }}"><i class="bx bx-edit-alt"></i></button>
                                        <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $country->id }}"><i class="bx bx-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $countries->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Country Modal -->
<div class="modal fade" id="countryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="countryModalLabel">Add New Country</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="countryForm">
                    @csrf
                    <input type="hidden" id="country_id" name="id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" required>
                            <div class="invalid-feedback" id="error-name"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ISO Code (2 chars) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="iso" id="iso" maxlength="2" required>
                            <div class="invalid-feedback" id="error-iso"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ISO3 Code (3 chars)</label>
                            <input type="text" class="form-control" name="iso3" id="iso3" maxlength="3">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phonecode" id="phonecode" required>
                            <div class="invalid-feedback" id="error-phonecode"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Currency Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="currency_code" id="currency_code" required maxlength="3">
                            <div class="invalid-feedback" id="error-currency_code"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Currency Symbol <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="currency_symbol" id="currency_symbol" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Min Phone Length <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="min_phone_length" id="min_phone_length" required value="10">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Max Phone Length <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="max_phone_length" id="max_phone_length" required value="15">
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-save">Save Country</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this country? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="btn-confirm-delete">Delete</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Open Modal for Create
        $('#btn-add-country').click(function() {
            $('#countryForm')[0].reset();
            $('#country_id').val('');
            $('#countryModalLabel').text('Add New Country');
            $('#btn-save').text('Create Country');
            $('.invalid-feedback').text('');
            $('.form-control').removeClass('is-invalid');
            $('#countryModal').modal('show');
        });

        // Edit Country
        $('body').on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.countries.index') }}/" + id + "/edit";
            
            $.get(url, function(data) {
                if(data.status) {
                    $('#countryModalLabel').text('Edit Country');
                    $('#btn-save').text('Update Country');
                    $('#country_id').val(data.data.id);
                    $('#name').val(data.data.name);
                    $('#iso').val(data.data.iso);
                    $('#iso3').val(data.data.iso3);
                    $('#phonecode').val(data.data.phonecode);
                    $('#currency_code').val(data.data.currency_code);
                    $('#currency_symbol').val(data.data.currency_symbol);
                    $('#min_phone_length').val(data.data.min_phone_length);
                    $('#max_phone_length').val(data.data.max_phone_length);
                    $('#is_active').prop('checked', data.data.is_active);
                    
                    $('.invalid-feedback').text('');
                    $('.form-control').removeClass('is-invalid');
                    $('#countryModal').modal('show');
                }
            });
        });

        // Submit Form
        $('#countryForm').submit(function(e) {
            e.preventDefault();
            var id = $('#country_id').val();
            var url = id ? "{{ route('admin.countries.index') }}/" + id : "{{ route('admin.countries.store') }}";
            var type = id ? "PUT" : "POST";
            
            $.ajax({
                url: url,
                type: type,
                data: $(this).serialize(),
                success: function(response) {
                    if(response.status) {
                        $('#countryModal').modal('hide');
                        $('#alert-container').html('<div class="alert alert-success">'+response.message+'</div>');

                    } else {
                        if(response.errors) {
                            $.each(response.errors, function(key, value) {
                                $('#'+key).addClass('is-invalid');
                                $('#error-'+key).text(value[0]);
                            });
                        }
                    }
                }
            });
        });

        // Delete Country
        var deleteId;

        $('body').on('click', '.btn-delete', function() {
            deleteId = $(this).data('id');
            $('#deleteModal').modal('show');
        });

        $('#btn-confirm-delete').click(function() {
            var url = "{{ route('admin.countries.index') }}/" + deleteId;
            
            $.ajax({
                url: url,
                type: "DELETE",
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    if(response.status) {
                        $('#row-'+deleteId).remove();
                        $('#alert-container').html('<div class="alert alert-success">'+response.message+'</div>');
                    } else {
                        $('#alert-container').html('<div class="alert alert-danger">'+response.message+'</div>');
                    }
                },
                error: function(xhr) {
                    $('#deleteModal').modal('hide');
                    $('#alert-container').html('<div class="alert alert-danger">An error occurred while deleting the country.</div>');
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endpush
@endsection
