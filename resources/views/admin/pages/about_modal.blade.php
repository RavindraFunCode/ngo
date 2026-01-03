<div class="modal fade" id="editFeatureModal{{ $feature->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('admin.about.page.feature.update', $feature->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header"><h5 class="modal-title">Edit Item</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label>Title</label><input type="text" class="form-control" name="title" value="{{ $feature->title }}" required></div>
                
                @if($type == 'about_intro')
                    <div class="mb-3"><label>Image</label><input type="file" class="form-control" name="image">
                    @if($feature->image)<div class="mt-2"><img src="{{ \Illuminate\Support\Str::startsWith($feature->image, 'website/') ? asset($feature->image) : asset('uploads/' . $feature->image) }}" width="40"></div>@endif</div>
                    <div class="mb-3"><label>Description</label><textarea class="form-control" name="description" rows="3">{{ $feature->description }}</textarea></div>
                @elseif($type == 'why_choose_us')
                    <div class="mb-3"><label>Icon Class</label><input type="text" class="form-control" name="icon" value="{{ $feature->icon }}"></div>
                    <div class="mb-3"><label>Description</label><textarea class="form-control" name="description" rows="3">{{ $feature->description }}</textarea></div>
                @elseif($type == 'about_counter')
                    <div class="mb-3"><label>Count Value</label><input type="text" class="form-control" name="subtitle" value="{{ $feature->subtitle }}"></div>
                    <div class="mb-3"><label>Icon Class</label><input type="text" class="form-control" name="icon" value="{{ $feature->icon }}"></div>
                @endif
                
                <div class="mb-3"><label>Order</label><input type="number" class="form-control" name="order" value="{{ $feature->order }}"></div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary">Save Changes</button></div>
        </form>
    </div>
</div>
