# Image Upload/Display Fix for Production

## Issue
Images not uploading or displaying on production server (cPanel)

## Common Causes & Solutions

### 1. Storage Permissions (Most Common)
```bash
# Via cPanel Terminal
cd public_html
chmod -R 775 storage
chmod -R 775 public/storage
chown -R username:username storage
```

### 2. Storage Link Missing
```bash
# Via cPanel Terminal
php artisan storage:link

# Or manually create symlink via cPanel File Manager:
# Create symbolic link from: storage/app/public
# To: public/storage
```

### 3. Check .env File
```env
# Ensure these are set correctly
FILESYSTEM_DISK=public
APP_URL=https://digitalleap.africa
```

### 4. Verify Storage Path
Check if `public/storage` symlink exists:
- Go to cPanel File Manager
- Navigate to `public/storage`
- Should show as symbolic link (arrow icon)
- If not, run: `php artisan storage:link`

### 5. Image Upload Path Issue
Images should be stored in: `storage/app/public/`
And accessed via: `public/storage/`

### 6. Check File Upload Limits
In cPanel → Select PHP Version → Options:
```ini
upload_max_filesize = 20M
post_max_size = 25M
max_execution_time = 300
memory_limit = 256M
```

### 7. Verify Image Paths in Code
Images should use:
```php
// Storing
$path = $request->file('image')->store('images', 'public');

// Displaying
<img src="{{ asset('storage/' . $path) }}">

// Or using accessor
<img src="{{ $model->image_url }}">
```

## Quick Diagnostic Script

Create `public/check-storage.php`:
```php
<?php
echo "<h2>Storage Diagnostic</h2>";

// Check if storage link exists
$storageLink = __DIR__.'/storage';
echo "Storage link exists: " . (is_link($storageLink) ? '✅ YES' : '❌ NO') . "<br>";

// Check if storage is writable
$storagePath = __DIR__.'/../storage/app/public';
echo "Storage writable: " . (is_writable($storagePath) ? '✅ YES' : '❌ NO') . "<br>";

// Check permissions
echo "Storage permissions: " . substr(sprintf('%o', fileperms($storagePath)), -4) . "<br>";

// List files
echo "<h3>Files in storage/app/public:</h3>";
if (is_dir($storagePath)) {
    $files = scandir($storagePath);
    echo "<pre>" . print_r($files, true) . "</pre>";
}

// Delete this file after use
unlink(__FILE__);
?>
```

Visit: `https://digitalleap.africa/check-storage.php`

## Manual Fix Steps

### Step 1: Via cPanel File Manager
1. Go to `storage/app/` folder
2. Check if `public` folder exists
3. If not, create it with permissions 775

### Step 2: Create Symbolic Link
1. Go to `public/` folder
2. Delete `storage` folder if it exists (and is not a symlink)
3. Via Terminal: `ln -s ../storage/app/public storage`

### Step 3: Set Permissions
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod -R 775 public/storage
```

### Step 4: Test Upload
1. Try uploading an image via admin panel
2. Check if file appears in `storage/app/public/`
3. Check if accessible via `public/storage/`

## Verify Image Display

### Check Model Accessor
Ensure models have image URL accessor:
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
    
    // Convert storage path to URL
    return asset('storage/' . $this->image);
}
```

### Check Blade Templates
Use accessor instead of direct attribute:
```blade
{{-- Wrong --}}
<img src="{{ $course->image }}">

{{-- Correct --}}
<img src="{{ $course->image_url }}">
```

## Common Errors & Solutions

### Error: "The file could not be uploaded"
- **Cause**: Permissions issue
- **Fix**: `chmod -R 775 storage`

### Error: "File not found"
- **Cause**: Storage link missing
- **Fix**: `php artisan storage:link`

### Error: Images upload but don't display
- **Cause**: Wrong path in blade
- **Fix**: Use `asset('storage/' . $path)` or `$model->image_url`

### Error: 404 on image URLs
- **Cause**: Symlink broken or missing
- **Fix**: Delete `public/storage` and run `php artisan storage:link`

## Production Checklist

- [ ] Storage permissions set to 775
- [ ] Storage link created (`php artisan storage:link`)
- [ ] `.env` has correct `APP_URL`
- [ ] PHP upload limits increased
- [ ] Models have `image_url` accessor
- [ ] Blade templates use `image_url` accessor
- [ ] Test image upload via admin panel
- [ ] Verify image displays on frontend

## Emergency Fix

If nothing works, manually create symlink:
```bash
cd public
rm -rf storage
ln -s ../storage/app/public storage
chmod -R 775 storage
```

---
**Note**: After fixing, clear cache:
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```
