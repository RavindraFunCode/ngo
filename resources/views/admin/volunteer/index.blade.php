@extends('layouts.admin')

@section('title', 'Volunteer Section')

@section('content')
<div class="row">
    <!-- Main Section Settings -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Main Section Settings</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.volunteer.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Background Image</label>
                        <input type="file" class="form-control" name="home_volunteer_bg_image">
                        @if(isset($settings['home_volunteer_bg_image']))
                            <div class="mt-2 text-center" style="background: #333; padding: 10px;">
                                <img src="{{ \Illuminate\Support\Str::startsWith($settings['home_volunteer_bg_image'], 'website/') ? asset($settings['home_volunteer_bg_image']) : asset('uploads/' . $settings['home_volunteer_bg_image']) }}" style="max-width: 100px;">
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="home_volunteer_title" value="{{ $settings['home_volunteer_title'] ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subtitle</label>
                        <input type="text" class="form-control" name="home_volunteer_subtitle" value="{{ $settings['home_volunteer_subtitle'] ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Text Content</label>
                        <textarea class="form-control" name="home_volunteer_text" rows="4">{{ $settings['home_volunteer_text'] ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" class="form-control" name="home_volunteer_btn_text" value="{{ $settings['home_volunteer_btn_text'] ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Button Link</label>
                        <input type="text" class="form-control" name="home_volunteer_btn_link" value="{{ $settings['home_volunteer_btn_link'] ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Settings</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Counters Management -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Counters</h4>
                <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addCounterModal">Add Counter</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Icon</th>
                                <th>Count</th>
                                <th>Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($counters as $counter)
                            <tr>
                                <td><i class="{{ $counter->icon }}"></i> ({{ $counter->icon }})</td>
                                <td>{{ $counter->subtitle }}</td>
                                <td>{{ $counter->title }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editCounterModal{{ $counter->id }}">Edit</button>
                                    <form action="{{ route('admin.volunteer.counter.destroy', $counter->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editCounterModal{{ $counter->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.volunteer.counter.update', $counter->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Counter</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Count Value</label>
                                                    <input type="text" class="form-control" name="subtitle" value="{{ $counter->subtitle }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Title</label>
                                                    <input type="text" class="form-control" name="title" value="{{ $counter->title }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Icon Class</label>
                                                    <input type="text" class="form-control" name="icon" value="{{ $counter->icon }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Order</label>
                                                    <input type="number" class="form-control" name="order" value="{{ $counter->order }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addCounterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.volunteer.counter.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Counter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Count Value</label>
                        <input type="text" class="form-control" name="subtitle" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon Class</label>
                        <input type="text" class="form-control" name="icon" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" class="form-control" name="order" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Counter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
