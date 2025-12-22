@extends('layouts.admin')

@section('title', 'Submission Details')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">{{ $contactSubmission->subject }}</h4>
                <span class="badge bg-{{ $contactSubmission->status == 'closed' ? 'success' : ($contactSubmission->status == 'new' ? 'danger' : 'warning') }}">
                    {{ ucfirst(str_replace('_', ' ', $contactSubmission->status)) }}
                </span>
            </div>
            <div class="card-body">
                <p><strong>From:</strong> {{ $contactSubmission->name }} &lt;{{ $contactSubmission->email }}&gt;</p>
                <p><strong>Phone:</strong> {{ $contactSubmission->phone ?? 'N/A' }}</p>
                <p><strong>Date:</strong> {{ $contactSubmission->created_at->format('d/m/Y H:i:s') }}</p>
                <hr>
                <p class="lead">{{ $contactSubmission->message }}</p>
                
                <hr>
                <form action="{{ route('admin.contact-submissions.update', $contactSubmission) }}" method="POST" class="mt-3">
                    @csrf
                    @method('PUT')
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label for="status" class="form-label">Update Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="new" {{ $contactSubmission->status == 'new' ? 'selected' : '' }}>New</option>
                                <option value="in_progress" {{ $contactSubmission->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="closed" {{ $contactSubmission->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Meta Info</h4>
            </div>
            <div class="card-body">
                <p><strong>IP Address:</strong> {{ $contactSubmission->ip_address ?? 'N/A' }}</p>
                <p><strong>User Agent:</strong> {{ $contactSubmission->user_agent ?? 'N/A' }}</p>
                @if($contactSubmission->handled_by)
                    <p><strong>Handled By:</strong> {{ $contactSubmission->handler->name ?? 'Unknown' }}</p>
                    <p><strong>Handled At:</strong> {{ $contactSubmission->handled_at->format('d/m/Y H:i') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <a href="{{ route('admin.contact-submissions.index') }}" class="btn btn-secondary">Back to Submissions</a>
    </div>
</div>
@endsection
