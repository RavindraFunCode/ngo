@extends('layouts.admin')

@section('title', 'Contact Submissions')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Contact Submissions</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($submissions as $submission)
                            <tr>
                                <td>
                                    {{ $submission->name }}<br>
                                    <small class="text-muted">{{ $submission->email }}</small>
                                </td>
                                <td>{{ $submission->subject }}</td>
                                <td>
                                    <span class="badge bg-{{ $submission->status == 'closed' ? 'success' : ($submission->status == 'new' ? 'danger' : 'warning') }}">
                                        {{ ucfirst(str_replace('_', ' ', $submission->status)) }}
                                    </span>
                                </td>
                                <td>{{ $submission->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.contact-submissions.show', $submission) }}" class="btn btn-sm btn-info">View</a>
                                    <form action="{{ route('admin.contact-submissions.destroy', $submission) }}" method="POST" class="d-inline">
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
                    {{ $submissions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
