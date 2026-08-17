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

    $row = [
        '5',
        'Test',
        'Check',
        'test@theparcfoundation.ph',
        'Philippines',
        'Manila',
        'Main St',
        '1000',
        '500',
        'once',
        'gcash',
        'no',
        'no',
        'No',
        'https://theparcfoundation.ph/receipts/test.jpg',
        date('Y-m-d H:i:s')
    ];

    $credentialsPath = base_path(env('GOOGLE_SHEETS_CREDENTIALS', 'storage/app/spheric-hawk-503003-u8-640ae5efc019.json'));
    
    $client = new Client();
    $client->setApplicationName('PARC Foundation');
    $client->setScopes([Sheets::SPREADSHEETS]);
    $client->setAuthConfig($credentialsPath);
    $client->setAccessType('offline');

    $service = new Sheets($client);

    $body = new ValueRange(['values' => [$row]]);
    $res = $service->spreadsheets_values->append(
        $sheetId,
        "{$tab}!A1",
        $body,
        [
            'valueInputOption'  => 'USER_ENTERED',
            'insertDataOption'  => 'INSERT_ROWS',
        ]
    );

    echo "WRITE SUCCESSFUL! Updated cells: " . $res->getUpdates()->getUpdatedCells() . "\n";

} catch (\Throwable $e) {
    echo "WRITE ERROR: " . $e->getMessage() . "\n";
}
