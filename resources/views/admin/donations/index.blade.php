@extends('layouts.admin')

@section('title', 'Donations')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Donations</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Donor</th>
                                <th>Campaign</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donations as $donation)
                            <tr>
                                <td>#{{ $donation->id }}</td>
                                <td>
                                    {{ $donation->donor_name }}<br>
                                    <small class="text-muted">{{ $donation->donor_email }}</small>
                                </td>
                                <td>{{ $donation->campaign ? ($donation->campaign->getTranslation(app()->getLocale())->title ?? 'N/A') : 'General Component' }}</td>
                                <td>{{ $donation->currency }} {{ number_format($donation->amount, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $donation->status == 'paid' ? 'success' : ($donation->status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($donation->status) }}
                                    </span>
                                </td>
                                <td>{{ $donation->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.donations.show', $donation) }}" class="btn btn-sm btn-info">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $donations->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
