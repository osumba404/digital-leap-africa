<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasWebPImages
{
    public function storeWebPImage(UploadedFile $file, string $directory, int $quality = 85): string
    {
        $filename = time() . '_' . uniqid() . '.webp';
        $path = $directory . '/' . $filename;
        
        // Create image resource from uploaded file
        $mimeType = $file->getMimeType();
        $filePath = $file->getRealPath();
        
        $image = match($mimeType) {
            'image/jpeg', 'image/jpg' => imagecreatefromjpeg($filePath),
            'image/png' => imagecreatefrompng($filePath),
            'image/gif' => imagecreatefromgif($filePath),
            'image/bmp', 'image/x-ms-bmp' => imagecreatefrombmp($filePath),
            'image/webp' => imagecreatefromwebp($filePath),
            default => imagecreatefromstring(file_get_contents($filePath))
        };
        
        if (!$image) {
            throw new \Exception('Failed to create image resource');
        }
        
        // Preserve transparency for PNG/GIF
        imagealphablending($image, false);
        imagesavealpha($image, true);
        
        // Convert to WebP
        ob_start();
        imagewebp($image, null, $quality);
        $webpContent = ob_get_clean();
        imagedestroy($image);
        
        Storage::disk('public')->put($path, $webpContent);
        
        return $path;
    }
    
    public function getWebPImageUrl(string $imagePath): ?string
    {
        if (!$imagePath) return null;
        
        if (preg_match('/^https?:\/\//i', $imagePath)) {
            return $imagePath;
        }
        
        return Storage::disk('public')->url($imagePath);
    }
}
