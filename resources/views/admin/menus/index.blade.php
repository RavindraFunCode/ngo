@extends('layouts.admin')

@section('title', 'Menus')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Menus</h4>
                <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">Add Menu</a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Identifier</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu)
                            <tr>
                                <td>{{ $menu->name }}</td>
                                <td><code>{{ $menu->identifier }}</code></td>
                                <td>
                                    @if($menu->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.menus.builder', $menu) }}" class="btn btn-sm btn-warning">Builder</a>
                                    <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
