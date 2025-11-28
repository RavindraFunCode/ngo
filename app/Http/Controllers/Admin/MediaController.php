<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    protected $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index()
    {
        $media = Media::latest()->paginate(20);
        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        if ($request->hasFile('file')) {
            $this->mediaService->upload($request->file('file'));
        }

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function destroy(Media $media)
    {
        $this->mediaService->delete($media);
        return redirect()->back()->with('success', 'File deleted successfully.');
    }
}
