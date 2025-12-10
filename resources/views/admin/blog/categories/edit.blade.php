@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Category</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blog.categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Slug <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="slug" value="{{ old('slug', $category->slug) }}" required maxlength="255">
                    </div>

                    <div class="mb-3 form-check">
                                <textarea class="form-control" name="translations[{{ $language->code }}][description]">{{ $translation->description ?? '' }}</textarea>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update Category</button>
                    <a href="{{ route('admin.blog.categories.index') }}" class="btn btn-secondary mt-3">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
