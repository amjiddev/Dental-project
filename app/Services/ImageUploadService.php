<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    /**
     * Upload an image to the uploads disk
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param string|null $prefix
     * @return string The path relative to public
     */
    public static function upload(UploadedFile $file, string $folder = '', string $prefix = null): string
    {
        $filename = ($prefix ? $prefix . '_' : '') . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        
        $path = $folder ? $folder . '/' . $filename : $filename;
        
        Storage::disk('uploads')->putFileAs(
            $folder,
            $file,
            $filename,
            'public'
        );
        
        return 'storage/uploads/' . $path;
    }

    /**
     * Delete an image
     *
     * @param string $path The path from public (storage/uploads/...)
     * @return bool
     */
    public static function delete(string $path): bool
    {
        if (!$path || !str_contains($path, 'storage/uploads/')) {
            return false;
        }
        
        $relativePath = str_replace('storage/uploads/', '', $path);
        return Storage::disk('uploads')->delete($relativePath);
    }
}
