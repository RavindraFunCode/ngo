@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Edit FAQ Category</h4>
            </div>
            <div class="card-body">
                <div id="alert-container"></div>
                <form id="editForm" action="{{ route('admin.faq-categories.update', $faqCategory) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label>Active</label>
                        <input type="checkbox" name="is_active" value="1" {{ $faqCategory->is_active ? 'checked' : '' }}>
                    </div>

                    <div class="mb-3">
                        <label>Order</label>
                        <input type="number" name="order" class="form-control" value="{{ $faqCategory->order }}">
                    </div>

                    <ul class="nav nav-tabs" id="langTab" role="tablist">
                        @foreach($languages as $language)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $language->code }}" data-bs-toggle="tab" data-bs-target="#lang-{{ $language->code }}" type="button" role="tab">{{ $language->name }}</button>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="langTabContent">
                        @foreach($languages as $language)
                            @php
                                $translation = $faqCategory->translations->where('language_id', $language->id)->first();
                            @endphp
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="lang-{{ $language->code }}" role="tabpanel">
                                <div class="mt-3">
                                    <div class="mb-3">
                                        <label for="name_{{ $language->code }}" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name_{{ $language->code }}" name="translations[{{ $language->code }}][name]" value="{{ $translation->name ?? '' }}" maxlength="255">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update Category</button>
                    <a href="{{ route('admin.faq-categories.index') }}" class="btn btn-secondary mt-3">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#editForm').submit(function(e) {
        e.preventDefault();
        
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
