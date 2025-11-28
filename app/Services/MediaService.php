<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaService
{
    public function upload(UploadedFile $file, $disk = 'public', $path = 'uploads')
    {
        $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs($path, $fileName, $disk);

        return Media::create([
            'file_name' => $fileName,
            'original_name' => $file->getClientOriginalName(),
            'disk' => $disk,
            'path' => $filePath,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'uploaded_by' => auth()->id(),
        ]);
    }

    public function delete(Media $media)
    {
        if (Storage::disk($media->disk)->exists($media->path)) {
            Storage::disk($media->disk)->delete($media->path);
        }

        $media->delete();
    }
}
