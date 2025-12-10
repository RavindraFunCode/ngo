<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $items = GalleryItem::latest()->get();
        return view('admin.gallery.index', compact('items'));
    }

    public function store(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'image' => 'required|image',
            'category' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }
        $data['is_active'] = $request->has('is_active');

        GalleryItem::create($data);
        return response()->json(['success' => 'Gallery item created successfully.']);
    }

    public function edit(GalleryItem $gallery)
    {
        return response()->json($gallery);
    }

    public function update(Request $request, GalleryItem $gallery)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'image' => 'nullable|image',
            'category' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }
        $data['is_active'] = $request->has('is_active');

        $gallery->update($data);
        return response()->json(['success' => 'Gallery item updated successfully.']);
    }

    public function destroy(GalleryItem $gallery)
    {
        $gallery->delete();
        return response()->json(['success' => 'Gallery item deleted successfully.']);
    }
}
