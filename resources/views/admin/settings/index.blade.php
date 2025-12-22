@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Settings</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Nav tabs -->
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#general" role="tab">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#contact" role="tab">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#social" role="tab">Social & SEO</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Welcome Title</label>
                                <input type="text" class="form-control" name="welcome_title" value="{{ $settings['home']->where('key', 'welcome_title')->first()->value ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Welcome Text</label>
                                <textarea class="form-control" name="welcome_text" rows="4">{{ $settings['home']->where('key', 'welcome_text')->first()->value ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="tab-pane" id="general" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Site Name</label>
                                <input type="text" class="form-control" name="site_name" value="{{ $settings['general']->where('key', 'site_name')->first()->value ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tagline</label>
                                <input type="text" class="form-control" name="site_tagline" value="{{ $settings['general']->where('key', 'site_tagline')->first()->value ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Default Country</label>
                                <select class="form-control" name="default_country">
                                    <option value="">Select Country</option>
                                    @foreach(\App\Models\Country::where('is_active', true)->get() as $country)
                                        <option value="{{ $country->id }}" {{ ($settings['general']->where('key', 'default_country')->first()->value ?? '') == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="tab-pane" id="contact" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Contact Email</label>
                                <input type="email" class="form-control" name="contact_email" value="{{ $settings['contact']->where('key', 'contact_email')->first()->value ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="contact_phone" value="{{ $settings['contact']->where('key', 'contact_phone')->first()->value ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="contact_address">{{ $settings['contact']->where('key', 'contact_address')->first()->value ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="tab-pane" id="social" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Facebook URL</label>
                                <input type="url" class="form-control" name="social_facebook" value="{{ $settings['social']->where('key', 'social_facebook')->first()->value ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Twitter URL</label>
                                <input type="url" class="form-control" name="social_twitter" value="{{ $settings['social']->where('key', 'social_twitter')->first()->value ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
