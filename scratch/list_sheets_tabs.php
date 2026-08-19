<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Google\Client;
use Google\Service\Sheets;

try {
    $credentialsPath = storage_path('app/spheric-hawk-503003-u8-640ae5efc019.json');
    $client = new Client();
    $client->setApplicationName('PARC Foundation');
    $client->setScopes([Sheets::SPREADSHEETS]);
    $client->setAuthConfig($credentialsPath);
    
    $service = new Sheets($client);
    $spreadsheetId = '1INqiJMGp8JZQzRksA3WPgCPVAMPkJgKiqbzN7iGkPIk';
    
    $spreadsheet = $service->spreadsheets->get($spreadsheetId);
    $sheets = $spreadsheet->getSheets();

    echo "Sheet tabs in Google Spreadsheet ($spreadsheetId):\n";
    foreach ($sheets as $sheet) {
        echo " - " . $sheet->getProperties()->getTitle() . "\n";
    }

} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
