<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageOptimizationService
{
    /**
     * Generate optimized image URLs with different sizes
     */
    public static function getOptimizedImageUrl($imageUrl, $width = null, $height = null, $quality = 85)
    {
        if (!$imageUrl) {
            return null;
        }

        // If it's an external URL, return as is for now
        if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
            return $imageUrl;
        }

        // Generate cache key
        $cacheKey = 'optimized_image_' . md5($imageUrl . $width . $height . $quality);
        
        return Cache::remember($cacheKey, 86400, function() use ($imageUrl, $width, $height, $quality) {
            // For now, return the original URL
            // In production, you could implement actual image optimization here
            return $imageUrl;
        });
    }

    /**
     * Generate responsive image srcset
     */
    public static function generateSrcSet($imageUrl, $sizes = [400, 800, 1200])
    {
        if (!$imageUrl) {
            return '';
        }

        $srcset = [];
        foreach ($sizes as $size) {
            $optimizedUrl = self::getOptimizedImageUrl($imageUrl, $size);
            $srcset[] = $optimizedUrl . ' ' . $size . 'w';
        }

        return implode(', ', $srcset);
    }

    /**
     * Generate WebP version of image URL
     */
    public static function getWebPUrl($imageUrl)
    {
        if (!$imageUrl || filter_var($imageUrl, FILTER_VALIDATE_URL)) {
            return $imageUrl;
        }

        // Convert extension to webp
        $pathInfo = pathinfo($imageUrl);
        if (isset($pathInfo['extension'])) {
            return str_replace('.' . $pathInfo['extension'], '.webp', $imageUrl);
        }

        return $imageUrl;
    }

    /**
     * Generate placeholder image data URL
     */
    public static function getPlaceholder($width = 400, $height = 240, $color = 'f3f4f6')
    {
        return "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 {$width} {$height}'%3E%3Crect width='{$width}' height='{$height}' fill='%23{$color}'/%3E%3C/svg%3E";
    }

    /**
     * Preload critical images
     */
    public static function preloadImage($imageUrl)
    {
        if (!$imageUrl) {
            return '';
        }

        return '<link rel="preload" as="image" href="' . $imageUrl . '">';
    }

    /**
     * Generate image with lazy loading attributes
     */
    public static function lazyImage($imageUrl, $alt = '', $class = '', $width = null, $height = null)
    {
        $placeholder = self::getPlaceholder($width ?: 400, $height ?: 240);
        $optimizedUrl = self::getOptimizedImageUrl($imageUrl, $width, $height);
        
        $attributes = [
            'src' => $placeholder,
            'data-src' => $optimizedUrl,
            'alt' => $alt,
            'class' => trim($class . ' lazy-load'),
            'loading' => 'lazy'
        ];

        if ($width) $attributes['width'] = $width;
        if ($height) $attributes['height'] = $height;

        $attributeString = '';
        foreach ($attributes as $key => $value) {
            $attributeString .= ' ' . $key . '="' . htmlspecialchars($value) . '"';
        }

        return '<img' . $attributeString . '>';
    }
}