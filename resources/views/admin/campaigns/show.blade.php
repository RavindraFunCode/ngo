@extends('layouts.admin')

@section('title', 'Campaign Details')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Campaign Details</h4>
            </div>
            <div class="card-body">
                @if($campaign->featured_image)
                    <img src="{{ asset('uploads/' . $campaign->featured_image) }}" alt="{{ $campaign->title }}" class="img-fluid mb-3 rounded">
                @endif
                <h5>{{ $campaign->title }}</h5>
                <p><strong>Status:</strong> <span class="badge bg-{{ $campaign->status == 'published' ? 'success' : 'secondary' }}">{{ ucfirst($campaign->status) }}</span></p>
                <p><strong>Goal Amount:</strong> ${{ number_format($campaign->target_amount, 2) }}</p>
                <p><strong>Raised Amount:</strong> ${{ number_format($campaign->raised_amount, 2) }}</p>
                <div class="progress mb-3" style="height: 20px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $campaign->raised_percent }}%;" aria-valuenow="{{ $campaign->raised_percent }}" aria-valuemin="0" aria-valuemax="100">{{ $campaign->raised_percent }}%</div>
                </div>
                <p><strong>Start Date:</strong> {{ $campaign->start_date ? $campaign->start_date->format('d M Y') : 'N/A' }}</p>
                <p><strong>End Date:</strong> {{ $campaign->end_date ? $campaign->end_date->format('d M Y') : 'N/A' }}</p>
                <hr>
                <h6>Description</h6>
                <p>{{ Str::limit(strip_tags($campaign->description), 200) }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Donations Received</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Transaction ID</th>
                                <th>Donor</th>
                                <th>Address</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Payment Method</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($campaign->donations as $donation)
                            <tr>
                                <td>#{{ $donation->id }}</td>
                                <td><small>{{ $donation->transaction_id ?? 'N/A' }}</small></td>
                                <td>
                                    {{ $donation->donor_name }}<br>
                                    <small>{{ $donation->donor_email }}</small><br>
                                    <small>{{ $donation->donor_phone }}</small>
                                </td>
                                <td><small>{{ Str::limit($donation->donor_address, 30) ?? 'N/A' }}</small></td>
                                <td>{{ $donation->currency }} {{ number_format($donation->amount, 2) }}</td>
                                <td>{{ $donation->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <span class="badge bg-{{ $donation->status == 'paid' ? 'success' : ($donation->status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($donation->status) }}
                                    </span>
                                </td>
                                <td>{{ ucfirst($donation->payment_gateway) }}</td>
                                <td>
                                    <a href="{{ route('admin.donations.show', $donation->id) }}" class="btn btn-sm btn-info">View Details</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">No donations received yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-secondary">Back to Campaigns</a>
    </div>
</div>
@endsection
