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

    public function index(Request $request)
    {
        $media = Media::latest()->paginate(20);
        
        if ($request->ajax()) {
            return view('admin.media.partials.media-grid', compact('media'))->render();
        }

        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|max:10240', // 10MB max per file
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $this->mediaService->upload($file);
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Files uploaded successfully.',
                'html' => $this->index($request) // Reuse index logic to get fresh grid
            ]);
        }

        return redirect()->back()->with('success', 'Files uploaded successfully.');
    }

    public function destroy(Request $request, Media $medium)
    {
        $this->mediaService->delete($medium);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'File deleted successfully.'
            ]);
        }

        return redirect()->back()->with('success', 'File deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:media,id',
        ]);

        foreach ($request->ids as $id) {
            $media = Media::find($id);
            if ($media) {
                $this->mediaService->delete($media);
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Selected files deleted successfully.'
            ]);
        }

        return redirect()->back()->with('success', 'Selected files deleted successfully.');
    }
}
