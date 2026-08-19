<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Helpers\GoogleSheetsExporter;

try {
    $sheetId  = '1INqiJMGp8JZQzRksA3WPgCPVAMPkJgKiqbzN7iGkPIk';
    $sheetTab = 'Contacts_Inquiry';

    $headers = [
        'First Name',
        'Last Name',
        'Email Address',
        'Phone Number',
        'Subject / Inquiry Type',
        'Message',
        'Date Submitted',
    ];

    $rawPhone = '+63 917 623 2840';
    $phoneDisplay = str_starts_with($rawPhone, '+') ? "'" . $rawPhone : $rawPhone;

    $row = [
        'Juan',
        'Dela Cruz',
        'juan.delacruz@example.com',
        $phoneDisplay,
        'General Inquiry',
        'Hello PARC Foundation, I would like to inquire about your shelter volunteer programs.',
        "'" . date('m/d/Y h:i A'),
    ];

    echo "Calling GoogleSheetsExporter::append() for Contacts_Inquiry tab...\n";
    GoogleSheetsExporter::append(
        spreadsheetId: $sheetId,
        tab:           $sheetTab,
        headers:       $headers,
        row:           $row
    );

    echo "SUCCESS! Row appended to Google Sheet ('Contacts_Inquiry') successfully!\n";

} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
