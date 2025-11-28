@extends('layouts.admin')

@section('title', 'Edit Permission')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Permission</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Permission Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Permission</button>
                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
