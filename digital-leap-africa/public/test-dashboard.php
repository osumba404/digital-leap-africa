<?php
// Test what's causing dashboard error
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Simulate authenticated request
$request = Illuminate\Http\Request::create('/dashboard', 'GET');
$response = $kernel->handle($request);

echo $response->getContent();

// Auto-delete
sleep(2);
unlink(__FILE__);
?>
