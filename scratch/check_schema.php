<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== ADOPTIONS INDEXES ===\n";
foreach (DB::select('SHOW INDEXES FROM adoptions') as $i) {
    echo "{$i->Key_name} ({$i->Column_name}) Non_unique: {$i->Non_unique}\n";
}

echo "\n=== DONATIONS INDEXES ===\n";
foreach (DB::select('SHOW INDEXES FROM donations') as $i) {
    echo "{$i->Key_name} ({$i->Column_name}) Non_unique: {$i->Non_unique}\n";
}
