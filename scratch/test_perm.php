<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

try {
    $sheetId = '1INqiJMGp8JZQzRksA3WPgCPVAMPkJgKiqbzN7iGkPIk';
    $tab = 'Donations';

    $credentialsPath = base_path(env('GOOGLE_SHEETS_CREDENTIALS', 'storage/app/spheric-hawk-503003-u8-640ae5efc019.json'));
    
    $client = new Client();
    $client->setApplicationName('PARC Foundation');
    $client->setScopes([Sheets::SPREADSHEETS]);
    $client->setAuthConfig($credentialsPath);
    $client->setAccessType('offline');

    $service = new Sheets($client);

    // Read existing rows
    $response = $service->spreadsheets_values->get($sheetId, "{$tab}!A1:Z5");
    $existing = $response->getValues();

    echo "SUCCESS! Sheet read successfully. Row count retrieved: " . count($existing ?? []) . "\n";

} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
