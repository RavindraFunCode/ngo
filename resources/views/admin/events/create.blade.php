@extends('layouts.admin')

@section('title', 'Add Event')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add New Event</h4>
            </div>
            <div class="card-body">
                <div id="alert-container"></div>
                <form id="createEventForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" name="slug" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Time</label>
                            <input type="text" name="start_time" class="form-control" placeholder="e.g. 09:30 PM">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Organizer</label>
                            <input type="text" name="organizer" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Featured Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    </div>

                    <hr>
                    <h5>Translations</h5>
                    <ul class="nav nav-tabs" id="langTab" role="tablist">
                        @foreach($languages as $index => $language)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $index === 0 ? 'active' : '' }}" id="tab-{{ $language->code }}" data-bs-toggle="tab" data-bs-target="#lang-{{ $language->code }}" type="button" role="tab">{{ $language->name }}</button>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content pt-3" id="langTabContent">
                        @foreach($languages as $index => $language)
                        <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="lang-{{ $language->code }}" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Title ({{ $language->code }}) <span class="text-danger">*</span></label>
                                <input type="text" name="translations[{{ $language->code }}][title]" class="form-control" {{ $language->is_default ? 'required' : '' }}>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description ({{ $language->code }})</label>
                                <textarea name="translations[{{ $language->code }}][description]" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary" id="submitBtn">Create Event</button>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#createEventForm').on('submit', function(e) {
        e.preventDefault();
        $('#submitBtn').prop('disabled', true).text('Creating...');
        $('#alert-container').html('');

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('admin.events.store') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    window.location.href = response.redirect;
                }
            },
            error: function(xhr) {
                $('#submitBtn').prop('disabled', false).text('Create Event');
                let errors = xhr.responseJSON.errors;
                let errorHtml = '<div class="alert alert-danger"><ul>';
                $.each(errors, function(key, value) {
                    errorHtml += '<li>' + value[0] + '</li>';
                });
                errorHtml += '</ul></div>';
                $('#alert-container').html(errorHtml);
                $("html, body").animate({ scrollTop: 0 }, "slow");
            }
        });
    });
</script>
@endpush
