@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Menu</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.menus.update', $menu) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $menu->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="identifier" class="form-label">Identifier</label>
                        <input type="text" class="form-control" id="identifier" name="identifier" value="{{ $menu->identifier }}" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" {{ $menu->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Is Active</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
