@extends('layouts.admin')

@section('title', 'Menu Builder: ' . $menu->name)

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Menu Items</h4>
            </div>
            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Custom Link
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <form action="{{ route('admin.menus.items.store', $menu) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="type" value="custom">
                                    <div class="mb-2">
                                        <label class="form-label">URL</label>
                                        <input type="text" class="form-control" name="url" placeholder="http://">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Link Text</label>
                                        <input type="text" class="form-control" name="title" placeholder="Menu Item">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Target</label>
                                        <select class="form-control" name="target">
                                            <option value="_self">Same Tab</option>
                                            <option value="_blank">New Tab</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Add to Menu</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Add more accordion items for Pages, Categories, etc. later -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Menu Structure</h4>
            </div>
            <div class="card-body">
                @if($menu->items->isEmpty())
                    <div class="alert alert-info">No items in this menu. Add some from the left.</div>
                @else
                    <ul id="menu-items" class="list-group">
                        @foreach($menu->items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $item->id }}">
                            <div>
                                <strong>{{ $item->getTranslation(app()->getLocale())->title ?? $item->getTranslation('en')->title ?? 'Item' }}</strong>
                                <small class="text-muted">({{ $item->url }})</small>
                            </div>
                            <div>
                                <form action="{{ route('admin.menus.items.destroy', [$menu, $item]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')">Delete</button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    var el = document.getElementById('menu-items');
    if(el) {
        var sortable = Sortable.create(el, {
            animation: 150,
            onEnd: function (evt) {
                // Logic to save order via AJAX would go here
                // For now, we just have the visual drag and drop
                console.log('Dropped');
            }
        });
    }
</script>
@endpush
