<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Helpers\GoogleSheetsExporter;

try {
    $sheetId  = '1INqiJMGp8JZQzRksA3WPgCPVAMPkJgKiqbzN7iGkPIk';
    $sheetTab = 'Donations';

    $headers = [
        'Donation ID',
        'First Name',
        'Last Name',
        'Email',
        'Contact #',
        'Country',
        'Province / Region',
        'City',
        'Barangay',
        'Street',
        'Postal Code',
        'Amount',
        'Give Type',
        'Payment Method',
        'Receipt',
        'Date Submitted',
    ];

    $row = [
        '100',
        'PhoneTest',
        'Donor',
        'phonetest@theparcfoundation.ph',
        '+63 905 123 4567',
        'Philippines',
        'Metro Manila (NCR)',
        'Quezon City',
        'Batasan Hills',
        '123 Main Street',
        '1100',
        '500',
        'once',
        'gcash',
        'https://theparcfoundation.ph/receipts/test.jpg',
        date('n/j/Y'),
    ];

    echo "Calling GoogleSheetsExporter::append()...\n";
    GoogleSheetsExporter::append(
        spreadsheetId: $sheetId,
        tab:           $sheetTab,
        headers:       $headers,
        row:           $row
    );

    echo "SUCCESS! Row appended to Google Sheet with Contact #!\n";

} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
