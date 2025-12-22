@extends('layouts.admin')

@section('title', 'Volunteers')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Volunteers</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($volunteers as $volunteer)
                            <tr>
                                <td>{{ $volunteer->name }}</td>
                                <td>{{ $volunteer->email }}</td>
                                <td>{{ $volunteer->phone }}</td>
                                <td>
                                    <span class="badge bg-{{ $volunteer->status == 'approved' ? 'success' : ($volunteer->status == 'new' ? 'primary' : ($volunteer->status == 'rejected' ? 'danger' : 'warning')) }}">
                                        {{ ucfirst(str_replace('_', ' ', $volunteer->status)) }}
                                    </span>
                                </td>
                                <td>{{ $volunteer->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.volunteers.show', $volunteer) }}" class="btn btn-sm btn-info">View</a>
                                    <form action="{{ route('admin.volunteers.destroy', $volunteer) }}" method="POST" class="d-inline">
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
                <div class="mt-3">
                    {{ $volunteers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
