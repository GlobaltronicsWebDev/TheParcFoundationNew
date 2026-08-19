<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Helpers\GoogleSheetsExporter;

try {
    $sheetId  = '1INqiJMGp8JZQzRksA3WPgCPVAMPkJgKiqbzN7iGkPIk';
    $sheetTab = 'Adoptions';

    $headers = [
        'Adoption ID', 'First Name', 'Last Name', 'Email',
        'Phone Number', 'Country', 'City', 'Street', 'Postal Code',
        'Package', 'Amount', 'Payment Method',
        'Receipt Uploaded', 'Date Submitted',
    ];

    $rawPhone = '+63 917 123 4567';
    $phoneDisplay = str_starts_with($rawPhone, '+') ? "'" . $rawPhone : $rawPhone;

    $row = [
        'ADPT-ID-001',
        'Maria',
        'Santos',
        'maria.santos@example.com',
        $phoneDisplay,
        'Philippines',
        'San Juan',
        '123 Lt. Artiaga St.',
        '1500',
        'SILVER (3 Months)',
        '15000',
        'ewallet',
        '=HYPERLINK("https://theparcfoundation.ph/storage/receipts/test_receipt.jpg", "View Receipt")',
        "'" . date('m/d/Y h:i A'),
    ];

    echo "Calling GoogleSheetsExporter::append() for Adoptions tab...\n";
    GoogleSheetsExporter::append(
        spreadsheetId: $sheetId,
        tab:           $sheetTab,
        headers:       $headers,
        row:           $row
    );

    echo "SUCCESS! Row appended to Google Sheet ('Adoptions') successfully!\n";

} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
