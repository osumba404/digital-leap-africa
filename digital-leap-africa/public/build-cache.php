<?php
// Web-based cache builder
// DELETE THIS FILE AFTER USE!

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

echo "<h2>Building Laravel Cache...</h2>";

try {
    // Config cache
    Artisan::call('config:cache');
    echo "✅ Config cached<br>";
    
    // Route cache
    Artisan::call('route:cache');
    echo "✅ Routes cached<br>";
    
    // View cache
    Artisan::call('view:cache');
    echo "✅ Views cached<br>";
    
    echo "<br><strong style='color: green;'>✅ ALL DONE! Site is ready.</strong><br>";
    echo "<br><a href='/dashboard'>Test Dashboard</a><br>";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}

echo "<br><br><strong style='color: red;'>⚠️ DELETE THIS FILE NOW!</strong>";

// Auto-delete
sleep(3);
unlink(__FILE__);
?>
