@extends('layouts.admin')

@section('title', 'Add Permission')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Permission</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.permissions.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Permission Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Permission</button>
                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
