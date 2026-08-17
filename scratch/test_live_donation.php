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

    $rawPhone = '+63 905 123 4567';
    $phoneFormatted = "'" . $rawPhone;

    $row = [
        '101',
        'PhoneFixTest',
        'Donor',
        'phonefix@theparcfoundation.ph',
        $phoneFormatted,
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

    echo "SUCCESS! Row appended with single apostrophe prefix for phone number!\n";

} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
