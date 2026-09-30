<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $response = (new App\Http\Controllers\NewsController)->index();
    $html = $response->render();
    echo "RENDER_SUCCESS: length = " . strlen($html) . "\n";
} catch (\Throwable $e) {
    echo "RENDER_ERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n";
}

try {
    $detailResponse = (new App\Http\Controllers\NewsController)->show(1);
    $detailHtml = $detailResponse->render();
    echo "DETAIL_RENDER_SUCCESS: length = " . strlen($detailHtml) . "\n";
} catch (\Throwable $e) {
    echo "DETAIL_RENDER_ERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n";
}
