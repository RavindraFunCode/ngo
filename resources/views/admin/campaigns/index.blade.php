@extends('layouts.admin')

@section('title', 'Campaigns')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Campaigns</h4>
                <a href="{{ route('admin.campaigns.create') }}" class="btn btn-primary">Add Campaign</a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title (Default)</th>
                                <th>Target</th>
                                <th>Raised</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($campaigns as $campaign)
                            <tr>
                                <td>{{ $campaign->getTranslation(app()->getLocale())->title ?? $campaign->getTranslation('en')->title ?? 'N/A' }}</td>
                                <td>{{ $campaign->currency }} {{ number_format($campaign->target_amount, 2) }}</td>
                                <td>{{ $campaign->currency }} {{ number_format($campaign->raised_amount, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $campaign->status == 'published' ? 'success' : ($campaign->status == 'draft' ? 'secondary' : 'warning') }}">
                                        {{ ucfirst($campaign->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.campaigns.edit', $campaign) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST" class="d-inline">
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
                    {{ $campaigns->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
