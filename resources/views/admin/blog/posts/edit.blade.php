@extends('layouts.admin')

@section('title', 'Edit Blog Post')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Blog Post</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blog.update', $blog) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ $blog->slug }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $blog->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->getTranslation(app()->getLocale())->name ?? $category->slug }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="published_at" class="form-label">Published At</label>
                            <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="{{ $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '' }}">
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label">Featured Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @if($blog->image)
                                <img src="{{ Storage::url($blog->image) }}" alt="Current Image" class="mt-2" style="height: 100px;">
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" {{ $blog->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Is Active</label>
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
                            $translation = $blog->getTranslation($language->code);
                        @endphp
                        <div class="tab-pane {{ $index === 0 ? 'active' : '' }}" id="lang-{{ $language->code }}" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="translations[{{ $language->code }}][title]" value="{{ $translation->title ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Excerpt</label>
                                <textarea class="form-control" name="translations[{{ $language->code }}][excerpt]" rows="3">{{ $translation->excerpt ?? '' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <textarea class="form-control editor" name="translations[{{ $language->code }}][content]" rows="10">{{ $translation->content ?? '' }}</textarea>
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

                    <button type="submit" class="btn btn-primary mt-3">Update Post</button>
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary mt-3">Cancel</a>
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
