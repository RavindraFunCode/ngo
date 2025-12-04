<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::orderBy('order')->get();
        return view('admin.features.index', compact('features'));
    }

    public function store(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image',
            'icon' => 'nullable|string|max:255',
            'order' => 'integer|unique:features,order',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('features', 'public');
        }
        $data['is_active'] = $request->has('is_active');

        Feature::create($data);
        return response()->json(['success' => 'Feature created successfully.']);
    }

    public function edit(Feature $feature)
    {
        return response()->json($feature);
    }

    public function update(Request $request, Feature $feature)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image',
            'icon' => 'nullable|string|max:255',
            'order' => 'integer|unique:features,order,' . $feature->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('features', 'public');
        }
        $data['is_active'] = $request->has('is_active');

        $feature->update($data);
        return response()->json(['success' => 'Feature updated successfully.']);
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();
        return response()->json(['success' => 'Feature deleted successfully.']);
    }
}
