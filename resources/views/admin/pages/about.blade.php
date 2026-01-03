@extends('layouts.admin')

@section('title', 'About Page Management')

@section('content')
<div class="row">
    <div class="col-12">
        <ul class="nav nav-tabs nav-bordered mb-3">
            <li class="nav-item">
                <a href="#main" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                    <span class="d-none d-md-block">Main Content</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#why" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">Why Choose Us</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#counters" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                    <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                    <span class="d-none d-md-block">Fact Counters</span>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <!-- Main Content Tab -->
            <div class="tab-pane show active" id="main">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><h4 class="card-title">Page Settings</h4></div>
                            <div class="card-body">
                                <form action="{{ route('admin.about.page.settings.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Hero Background Image</label>
                                        <input type="file" class="form-control" name="about_page_bg_image">
                                        @if(isset($settings['about_page_bg_image']))
                                            <div class="mt-2"><img src="{{ \Illuminate\Support\Str::startsWith($settings['about_page_bg_image'], 'website/') ? asset($settings['about_page_bg_image']) : asset('uploads/' . $settings['about_page_bg_image']) }}" width="100"></div>
                                        @endif
                                    </div>
                                    <hr>
                                    <h5>Right Column Content</h5>
                                    <div class="mb-3">
                                        <label class="form-label">Title (Years of Experience)</label>
                                        <input type="text" class="form-control" name="about_page_right_title" value="{{ $settings['about_page_right_title'] ?? 'Years of Experience' }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Intro Text</label>
                                        <textarea class="form-control" name="about_page_right_text_1" rows="3">{{ $settings['about_page_right_text_1'] ?? '' }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Main Text</label>
                                        <textarea class="form-control" name="about_page_right_text_2" rows="3">{{ $settings['about_page_right_text_2'] ?? '' }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Checklist (One per line)</label>
                                        <textarea class="form-control" name="about_page_checklist" rows="4">{{ $settings['about_page_checklist'] ?? '' }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Settings</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Left Column Features</h4>
                                <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addIntroFeatureModal">Add Feature</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead><tr><th>Image</th><th>Content</th><th>Action</th></tr></thead>
                                    <tbody>
                                        @foreach($introFeatures as $f)
                                        <tr>
                                            <td>@if($f->image)<img src="{{ \Illuminate\Support\Str::startsWith($f->image, 'website/') ? asset($f->image) : asset('uploads/' . $f->image) }}" width="40">@endif</td>
                                            <td>
                                                <b>{{ $f->title }}</b><br>
                                                <small>{{ \Illuminate\Support\Str::limit($f->description, 50) }}</small>
                                            </td>
                                            <td>
                                                <button class="btn btn-xs btn-info" data-bs-toggle="modal" data-bs-target="#editFeatureModal{{ $f->id }}">Edit</button>
                                                <form action="{{ route('admin.about.page.feature.destroy', $f->id) }}" method="POST" style="display:inline;">@csrf @method('DELETE') <button class="btn btn-xs btn-danger" onclick="return confirm('Sure?')">X</button></form>
                                            </td>
                                        </tr>
                                        <!-- Edit Modal Reuse Logic Here -->
                                        @include('admin.pages.about_modal', ['feature' => $f, 'type' => 'about_intro'])
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Why Choose Us Tab -->
            <div class="tab-pane" id="why">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Why Choose Us Items</h4>
                        <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addWhyFeatureModal">Add Item</button>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead><tr><th>Icon</th><th>Title</th><th>Text</th><th>Action</th></tr></thead>
                            <tbody>
                                @foreach($whyChooseFeatures as $f)
                                <tr>
                                    <td><i class="{{ $f->icon }}"></i></td>
                                    <td>{{ $f->title }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($f->description, 50) }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editFeatureModal{{ $f->id }}">Edit</button>
                                        <form action="{{ route('admin.about.page.feature.destroy', $f->id) }}" method="POST" style="display:inline;">@csrf @method('DELETE') <button class="btn btn-sm btn-danger" onclick="return confirm('Sure?')">Del</button></form>
                                    </td>
                                </tr>
                                @include('admin.pages.about_modal', ['feature' => $f, 'type' => 'why_choose_us'])
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Counters Tab -->
            <div class="tab-pane" id="counters">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Fact Counters</h4>
                        <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addCounterFeatureModal">Add Counter</button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">These counters are specific to the About Us page.</div>
                        <div class="mb-3">
                            <label class="form-label">Background Image</label>
                            <form action="{{ route('admin.about.page.settings.update') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2">
                                @csrf
                                <input type="file" class="form-control" name="about_page_counter_bg">
                                <button class="btn btn-primary">Update BG</button>
                            </form>
                            @if(isset($settings['about_page_counter_bg']))
                                <div class="mt-2"><img src="{{ \Illuminate\Support\Str::startsWith($settings['about_page_counter_bg'], 'website/') ? asset($settings['about_page_counter_bg']) : asset('uploads/' . $settings['about_page_counter_bg']) }}" width="100"></div>
                            @endif
                        </div>

                        <table class="table">
                            <thead><tr><th>Icon</th><th>Count</th><th>Title</th><th>Action</th></tr></thead>
                            <tbody>
                                @foreach($counters as $f)
                                <tr>
                                    <td><i class="{{ $f->icon }}"></i></td>
                                    <td>{{ $f->subtitle }}</td>
                                    <td>{{ $f->title }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editFeatureModal{{ $f->id }}">Edit</button>
                                        <form action="{{ route('admin.about.page.feature.destroy', $f->id) }}" method="POST" style="display:inline;">@csrf @method('DELETE') <button class="btn btn-sm btn-danger" onclick="return confirm('Sure?')">Del</button></form>
                                    </td>
                                </tr>
                                @include('admin.pages.about_modal', ['feature' => $f, 'type' => 'about_counter'])
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Modals -->
<!-- Intro Feature Add -->
<div class="modal fade" id="addIntroFeatureModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('admin.about.page.feature.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="about_intro">
            <div class="modal-header"><h5 class="modal-title">Add Intro Feature</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label>Title</label><input type="text" class="form-control" name="title" required></div>
                <div class="mb-3"><label>Image</label><input type="file" class="form-control" name="image"></div>
                <div class="mb-3"><label>Description</label><textarea class="form-control" name="description" rows="3"></textarea></div>
                <div class="mb-3"><label>Order</label><input type="number" class="form-control" name="order" value="0"></div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary">Save</button></div>
        </form>
    </div>
</div>

<!-- Why Choose Us Add -->
<div class="modal fade" id="addWhyFeatureModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('admin.about.page.feature.store') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="why_choose_us">
            <div class="modal-header"><h5 class="modal-title">Add Why Choose Us Item</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label>Title</label><input type="text" class="form-control" name="title" required></div>
                <div class="mb-3"><label>Icon Class</label><input type="text" class="form-control" name="icon"></div>
                <div class="mb-3"><label>Description</label><textarea class="form-control" name="description" rows="3"></textarea></div>
                <div class="mb-3"><label>Order</label><input type="number" class="form-control" name="order" value="0"></div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary">Save</button></div>
        </form>
    </div>
</div>

<!-- Counter Add -->
<div class="modal fade" id="addCounterFeatureModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('admin.about.page.feature.store') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="about_counter">
            <div class="modal-header"><h5 class="modal-title">Add Counter</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label>Title</label><input type="text" class="form-control" name="title" required></div>
                <div class="mb-3"><label>Count Value</label><input type="text" class="form-control" name="subtitle" required></div>
                <div class="mb-3"><label>Icon Class</label><input type="text" class="form-control" name="icon"></div>
                <div class="mb-3"><label>Order</label><input type="number" class="form-control" name="order" value="0"></div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary">Save</button></div>
        </form>
    </div>
</div>
@endsection
