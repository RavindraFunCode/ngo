@extends('layouts.admin')

@section('title', 'Donation Details')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Donation #{{ $donation->id }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-{{ $donation->status == 'paid' ? 'success' : ($donation->status == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($donation->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>{{ $donation->currency }} {{ number_format($donation->amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Campaign</th>
                        <td>{{ $donation->campaign->getTranslation(app()->getLocale())->title ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Transaction ID</th>
                        <td>{{ $donation->transaction_id ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Payment Gateway</th>
                        <td>{{ $donation->payment_gateway }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ $donation->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Donor Details</h4>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $donation->donor_name }}</p>
                <p><strong>Email:</strong> {{ $donation->donor_email }}</p>
                <p><strong>Phone:</strong> {{ $donation->donor_phone ?? 'N/A' }}</p>
                <p><strong>Address:</strong> {{ $donation->donor_address ?? 'N/A' }}</p>
                <p><strong>Anonymous:</strong> {{ $donation->is_anonymous ? 'Yes' : 'No' }}</p>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary">Back to Donations</a>
    </div>
</div>
@endsection
