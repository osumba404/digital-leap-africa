<?php
// Emergency config cache clear script
// Delete this file after use!

$bootstrapPath = __DIR__.'/../bootstrap/cache/config.php';

if (file_exists($bootstrapPath)) {
    unlink($bootstrapPath);
    echo "✅ Config cache cleared successfully!<br>";
} else {
    echo "ℹ️ No config cache found.<br>";
}

echo "<br>Now run: php artisan config:cache<br>";
echo "<br><strong>⚠️ DELETE THIS FILE IMMEDIATELY FOR SECURITY!</strong>";

// Auto-delete this file
unlink(__FILE__);
?>
