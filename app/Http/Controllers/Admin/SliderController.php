<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function store(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'image' => 'required|image',
            'order' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }
        $data['is_active'] = $request->has('is_active');

        Slider::create($data);
        return response()->json(['success' => 'Slider created successfully.']);
    }

    public function edit(Slider $slider)
    {
        return response()->json($slider);
    }

    public function update(Request $request, Slider $slider)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'image' => 'nullable|image',
            'order' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }
        $data['is_active'] = $request->has('is_active');

        $slider->update($data);
        return response()->json(['success' => 'Slider updated successfully.']);
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return response()->json(['success' => 'Slider deleted successfully.']);
    }
}
