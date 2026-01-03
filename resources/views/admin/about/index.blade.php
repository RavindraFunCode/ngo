@extends('layouts.admin')

@section('title', 'About Section')

@section('content')
<div class="row">
    <!-- Main Section Settings -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Section Settings</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.about.settings.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Section Title (About Our Humanity)</label>
                        <input type="text" class="form-control" name="about_section_title" value="{{ $settings['about_section_title'] ?? '' }}">
                    </div>
                    <hr>
                    <h5>Right Column Content</h5>
                    <div class="mb-3">
                        <label class="form-label">Title (Years of Experience)</label>
                        <input type="text" class="form-control" name="about_right_title" value="{{ $settings['about_right_title'] ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Intro Text</label>
                        <textarea class="form-control" name="about_right_text_1" rows="3">{{ $settings['about_right_text_1'] ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Main Text</label>
                        <textarea class="form-control" name="about_right_text_2" rows="3">{{ $settings['about_right_text_2'] ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">List Items (One per line)</label>
                        <textarea class="form-control" name="about_right_list" rows="4">{{ $settings['about_right_list'] ?? '' }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Settings</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Features Management -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Features (Left Column)</h4>
                <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addFeatureModal">Add Feature</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($features as $feature)
                            <tr>
                                <td>
                                    @if($feature->image)
                                        <img src="{{ \Illuminate\Support\Str::startsWith($feature->image, 'website/') ? asset($feature->image) : asset('uploads/' . $feature->image) }}" width="50">
                                    @endif
                                </td>
                                <td>{{ $feature->title }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($feature->description, 50) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editFeatureModal{{ $feature->id }}">Edit</button>
                                    <form action="{{ route('admin.about.feature.destroy', $feature->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editFeatureModal{{ $feature->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.about.feature.update', $feature->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Feature</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Title</label>
                                                    <input type="text" class="form-control" name="title" value="{{ $feature->title }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Image</label>
                                                    <input type="file" class="form-control" name="image">
                                                    @if($feature->image)
                                                        <div class="mt-2">
                                                            <img src="{{ \Illuminate\Support\Str::startsWith($feature->image, 'website/') ? asset($feature->image) : asset('uploads/' . $feature->image) }}" width="50">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control" name="description" rows="3" required>{{ $feature->description }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Order</label>
                                                    <input type="number" class="form-control" name="order" value="{{ $feature->order }}">
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
<div class="modal fade" id="addFeatureModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.about.feature.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Feature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" class="form-control" name="order" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Feature</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
