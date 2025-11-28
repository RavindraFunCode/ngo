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
                <form action="{{ route('admin.campaigns.update', $campaign) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ $campaign->slug }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="draft" {{ $campaign->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ $campaign->status == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="archived" {{ $campaign->status == 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="target_amount" class="form-label">Target Amount</label>
                            <input type="number" step="0.01" class="form-control" id="target_amount" name="target_amount" value="{{ $campaign->target_amount }}">
                        </div>
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $campaign->start_date ? $campaign->start_date->format('Y-m-d') : '' }}">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $campaign->end_date ? $campaign->end_date->format('Y-m-d') : '' }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="featured_image" class="form-label">Featured Image</label>
                        <input type="file" class="form-control" id="featured_image" name="featured_image">
                        @if($campaign->featured_image)
                            <img src="{{ Storage::url($campaign->featured_image) }}" alt="Current Image" class="mt-2" style="height: 100px;">
                        @endif
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" {{ $campaign->is_featured ? 'checked' : '' }}>
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
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="translations[{{ $language->code }}][title]" value="{{ $translation->title ?? '' }}">
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
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    document.querySelectorAll('.editor').forEach(function(element) {
        CKEDITOR.replace(element);
    });
</script>
@endpush
