<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    /**
     * Upload file to storage/public and return URL public.
     *
     * @param UploadedFile|null $file
     * @param string $folder
     * @return string|null
     */
    public static function upload(?UploadedFile $file, string $folder = 'uploads'): ?string
    {
        if (!$file) {
            return null;
        }

        $path = $file->store($folder, 'public');
        return asset('storage/' . $path);
    }

    /**
     * Delete file from storage/public.
     *
     * @param string|null $filePath
     * @return bool
     */
    public static function delete(?string $filePath): bool
    {
        if (!$filePath) {
            return false;
        }

        $relativePath = str_replace(asset('storage/'), '', $filePath);

        return Storage::disk('public')->delete($relativePath);
    }
}
