<?php
/**
 * Clear all Laravel caches via browser
 * Visit: https://digitalleap.africa/clear-cache.php
 * DELETE THIS FILE after running!
 */

$basePath = dirname(__DIR__);

// Clear bootstrap cache
$files = [
    $basePath . '/bootstrap/cache/config.php',
    $basePath . '/bootstrap/cache/routes.php',
    $basePath . '/bootstrap/cache/routes-v7.php',
    $basePath . '/bootstrap/cache/services.php',
    $basePath . '/bootstrap/cache/packages.php',
];

$cleared = [];
foreach ($files as $file) {
    if (file_exists($file)) {
        unlink($file);
        $cleared[] = basename($file);
    }
}

echo "<h2>✅ Cache Cleared Successfully!</h2>";
echo "<p>Deleted files:</p><ul>";
foreach ($cleared as $file) {
    echo "<li>$file</li>";
}
echo "</ul>";
echo "<p><strong>⚠️ IMPORTANT: Delete this file (clear-cache.php) now for security!</strong></p>";
echo "<p><a href='/dashboard'>Go to Dashboard</a></p>";
