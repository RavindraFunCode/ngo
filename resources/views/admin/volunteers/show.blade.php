@extends('layouts.admin')

@section('title', 'Volunteer Details')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">{{ $volunteer->name }}</h4>
                <span class="badge bg-{{ $volunteer->status == 'approved' ? 'success' : ($volunteer->status == 'new' ? 'primary' : ($volunteer->status == 'rejected' ? 'danger' : 'warning')) }}">
                    {{ ucfirst(str_replace('_', ' ', $volunteer->status)) }}
                </span>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Email</th>
                        <td>{{ $volunteer->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $volunteer->phone }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $volunteer->address }}</td>
                    </tr>
                    <tr>
                        <th>Nationality</th>
                        <td>{{ $volunteer->nationality }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{ $volunteer->gender }}</td>
                    </tr>
                    <tr>
                        <th>Age Group</th>
                        <td>{{ $volunteer->age_group }}</td>
                    </tr>
                    <tr>
                        <th>Availability</th>
                        <td>{{ $volunteer->availability }}</td>
                    </tr>
                    <tr>
                        <th>Interest Areas</th>
                        <td>
                            @if($volunteer->interest_areas)
                                @foreach($volunteer->interest_areas as $area)
                                    <span class="badge bg-secondary">{{ $area }}</span>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Experience</th>
                        <td>{{ $volunteer->experience }}</td>
                    </tr>
                    <tr>
                        <th>Notes</th>
                        <td>{{ $volunteer->notes }}</td>
                    </tr>
                </table>

                <hr>

                <form action="{{ route('admin.volunteers.update', $volunteer) }}" method="POST" class="mt-3">
                    @csrf
                    @method('PUT')
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label for="status" class="form-label">Update Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="new" {{ $volunteer->status == 'new' ? 'selected' : '' }}>New</option>
                                <option value="in_review" {{ $volunteer->status == 'in_review' ? 'selected' : '' }}>In Review</option>
                                <option value="approved" {{ $volunteer->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $volunteer->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
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
</div>
<div class="row mt-3">
    <div class="col-12">
        <a href="{{ route('admin.volunteers.index') }}" class="btn btn-secondary">Back to Volunteers</a>
    </div>
</div>
@endsection
