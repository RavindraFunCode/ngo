@extends('layouts.admin')

@section('title', 'Edit Campaign')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Campaign</h4>
            </div>
            <div class="card-body">
                <div id="alert-container"></div>
                <form id="editForm" action="{{ route('admin.campaigns.update', $campaign) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Slug <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="slug" value="{{ old('slug', $campaign->slug) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="status" required>
                            <option value="draft" {{ $campaign->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ $campaign->status == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ $campaign->status == 'archived' ? 'selected' : '' }}>Archived</option>
                            <option value="completed" {{ $campaign->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Target Amount <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control" name="target_amount" value="{{ old('target_amount', $campaign->target_amount) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control" name="start_date" value="{{ old('start_date', $campaign->start_date ? $campaign->start_date->format('Y-m-d') : '') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" class="form-control" name="end_date" value="{{ old('end_date', $campaign->end_date ? $campaign->end_date->format('Y-m-d') : '') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Featured Image</label>
                        <input type="file" class="form-control" name="featured_image">
                        @if($campaign->featured_image)
                            <div class="mt-2">
                                <img src="{{ Storage::url($campaign->featured_image) }}" width="100" alt="Featured Image">
                            </div>
                        @endif
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="is_featured" id="is_featured" {{ $campaign->is_featured ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Is Featured</label>
                    </div>

                    <!-- Language Tabs -->
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        @foreach($languages as $index => $language)
                        <li class="nav-item">
                            <a class="nav-link {{ $index === 0 ? 'active' : '' }}" data-bs-toggle="tab" href="#lang-{{ $language->code }}" role="tab">
                                {{ $language->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach($languages as $index => $language)
                        @php
                            $translation = $campaign->getTranslation($language->code);
                        @endphp
                        <div class="tab-pane {{ $index === 0 ? 'active' : '' }}" id="lang-{{ $language->code }}" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="translations[{{ $language->code }}][title]" value="{{ $translation->title ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Short Description</label>
                                <textarea class="form-control" name="translations[{{ $language->code }}][short_description]" rows="3">{{ $translation->short_description ?? '' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Full Description</label>
                                <textarea class="form-control editor" name="translations[{{ $language->code }}][full_description]" rows="10">{{ $translation->full_description ?? '' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meta Title</label>
                                <input type="text" class="form-control" name="translations[{{ $language->code }}][meta_title]" value="{{ $translation->meta_title ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meta Description</label>
                                <textarea class="form-control" name="translations[{{ $language->code }}][meta_description]">{{ $translation->meta_description ?? '' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meta Keywords</label>
                                <input type="text" class="form-control" name="translations[{{ $language->code }}][meta_keywords]" value="{{ $translation->meta_keywords ?? '' }}">
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update Campaign</button>
                    <a href="{{ route('admin.campaigns.index') }}" class="btn btn-secondary mt-3">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/library/ckeditor/ckeditor.js') }}"></script>
<script>
    document.querySelectorAll('.editor').forEach(function(element) {
        CKEDITOR.replace(element);
    });

    $('#editForm').submit(function(e) {
        e.preventDefault();
        for (let instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
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
                console.error(xhr);
                var alertHtml = '';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    var errorHtml = '<ul>';
                    $.each(errors, function(key, value) {
                        errorHtml += '<li>' + value[0] + '</li>';
                    });
                    errorHtml += '</ul>';
                    alertHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        errorHtml +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>';
                } else {
                     alertHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        'An unexpected error occurred. Please check console for details.' +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>';
                }
                $('#alert-container').html(alertHtml);
                $('html, body').animate({ scrollTop: 0 }, 'slow');
            }
        });
    });
</script>
@endpush
