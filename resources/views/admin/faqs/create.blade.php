@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Add FAQ</h4>
            </div>
            <div class="card-body">
                <div id="alert-container"></div>
                <form id="createForm" action="{{ route('admin.faqs.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label>Active</label>
                        <input type="checkbox" name="is_active" value="1" checked>
                    </div>

                    <div class="mb-3">
                        <label>Order</label>
                        <input type="number" name="order" class="form-control" value="0">
                    </div>

                    <div class="mb-3">
                        <label>Category</label>
                        <select name="faq_category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->getTranslation(app()->getLocale())->name ?? $category->getTranslation('en')->name ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>
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
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="lang-{{ $language->code }}" role="tabpanel">
                                <div class="mt-3">
                                    <div class="mb-3">
                                        <label for="question_{{ $language->code }}" class="form-label">Question</label>
                                        <input type="text" class="form-control" id="question_{{ $language->code }}" name="translations[{{ $language->code }}][question]" maxlength="255">
                                    </div>
                                    <div class="mb-3">
                                        <label for="answer_{{ $language->code }}" class="form-label">Answer</label>
                                        <textarea class="form-control" id="answer_{{ $language->code }}" name="translations[{{ $language->code }}][answer]" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Save FAQ</button>
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary mt-3">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#createForm').submit(function(e) {
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
