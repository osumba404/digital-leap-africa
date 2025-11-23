# Public Storage Folder Fix

## Your Setup
Images stored in: `public/storage/` (direct folder, not symlink)

## Quick Fix

### 1. Update .env
```env
# Change from:
FILESYSTEM_DISK=local

# To:
FILESYSTEM_DISK=public
```

### 2. Ensure Folder Exists
Via cPanel File Manager:
- Check if `public/storage/` folder exists
- If not, create it
- Set permissions to 775

### 3. Update Image Paths in Code

**For Uploads:**
```php
// Store directly in public/storage
$path = $request->file('image')->move(
    public_path('storage/images'),
    $filename
);

// Save relative path to database
$model->image = 'storage/images/' . $filename;
```

**For Display:**
```blade
{{-- Direct path --}}
<img src="{{ asset($model->image) }}">

{{-- Or with full URL --}}
<img src="{{ url($model->image) }}">
```

### 4. Model Accessor (if using)
```php
public function getImageUrlAttribute()
{
    if (!$this->image) {
        return null;
    }
    
    // If already full URL
    if (preg_match('/^https?:\/\//i', $this->image)) {
        return $this->image;
    }
    
    // Return asset URL
    return asset($this->image);
}
```

## Verify Setup

1. Check folder exists: `public/storage/`
2. Check permissions: `chmod 775 public/storage`
3. Test upload via admin panel
4. Verify image URL: `https://digitalleap.africa/storage/images/filename.jpg`

## Common Issues

**Images not displaying:**
- Check if path in database is: `storage/images/filename.jpg` (no leading slash)
- Use `asset()` helper in blade: `{{ asset($model->image) }}`

**Upload fails:**
- Check folder permissions: `chmod -R 775 public/storage`
- Check PHP upload limits in cPanel

**404 on images:**
- Verify file exists in `public/storage/`
- Check .htaccess allows access to storage folder

## .htaccess Rule (if needed)
Add to `public/.htaccess`:
```apache
# Allow access to storage folder
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_URI} ^/storage/
    RewriteRule ^ - [L]
</IfModule>
```
