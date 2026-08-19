<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$adoptions = \App\Models\Adoption::all();
foreach ($adoptions as $a) {
    echo "ID: {$a->id}\n";
    echo "Name: {$a->fname} {$a->lname}\n";
    echo "Receipt Path: " . ($a->receipt_path ?: 'NULL') . "\n";
    echo "Created At: {$a->created_at}\n";
    echo "----------------------------------------\n";
}
