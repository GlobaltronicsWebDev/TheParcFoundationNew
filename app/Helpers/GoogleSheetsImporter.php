<?php

namespace App\Helpers;

use App\Models\Donation;
use App\Models\Adoption;
use Illuminate\Support\Facades\Schema;

class GoogleSheetsImporter
{
    /**
     * Build map of normalized column names to row index from header row.
     */
    private static function buildHeaderMap(array $header): array
    {
        $map = [];
        foreach ($header as $idx => $name) {
            $key = strtolower(trim((string) $name));
            if ($key !== '') {
                $map[$key] = $idx;
            }
        }
        return $map;
    }

    /**
     * Extract cell value using alias header names or fallback index.
     */
    private static function getCell(array $row, array $headerMap, array $aliases, int $fallbackIdx, string $default = ''): string
    {
        foreach ($aliases as $alias) {
            $key = strtolower(trim($alias));
            if (isset($headerMap[$key])) {
                $colIdx = $headerMap[$key];
                if (isset($row[$colIdx])) {
                    $val = trim((string) $row[$colIdx]);
                    if ($val !== '') {
                        return $val;
                    }
                }
            }
        }

        if (isset($row[$fallbackIdx])) {
            $val = trim((string) $row[$fallbackIdx]);
            if ($val !== '') {
                return $val;
            }
        }

        return $default;
    }

    /**
     * Extract clean path or URL from receipt cell (handles =HYPERLINK formula or raw text).
     */
    private static function parseReceiptCell(string $raw): ?string
    {
        if (empty($raw)) {
            return null;
        }

        // Match formula: =HYPERLINK("http...", "View Receipt")
        if (preg_match('/=HYPERLINK\(\s*"([^"]+)"/i', $raw, $m)) {
            return $m[1];
        }

        if (str_starts_with($raw, '=') || $raw === 'View Receipt') {
            return null;
        }

        return $raw;
    }

    /**
     * Sync Donations tab from Google Sheets into MySQL database.
     *
     * @return array Summary of synced, skipped, and total records.
     */
    public static function syncDonations(): array
    {
        $sheetId  = env('GOOGLE_SHEET_DONATIONS_ID') ?: '1INqiJMGp8JZQzRksA3WPgCPVAMPkJgKiqbzN7iGkPIk';
        $sheetTab = env('GOOGLE_SHEET_DONATIONS_TAB') ?: 'Donations';

        $rows = self::fetchRows($sheetId, $sheetTab);
        if (count($rows) <= 1) {
            return ['synced' => 0, 'skipped' => 0, 'total' => 0];
        }

        // Header row is index 0
        $header = array_shift($rows);
        $headerMap = self::buildHeaderMap($header);

        $synced = 0;
        $skipped = 0;
        $hasPhoneColumn = Schema::hasColumn('donations', 'phone');

        foreach ($rows as $row) {
            if (empty($row) || count($row) < 3) {
                continue;
            }

            $fname   = self::getCell($row, $headerMap, ['first name', 'fname'], 1, 'Anonymous');
            $lname   = self::getCell($row, $headerMap, ['last name', 'lname'], 2, '');
            $email   = self::getCell($row, $headerMap, ['email', 'email address'], 3, '');
            $phone   = self::getCell($row, $headerMap, ['contact #', 'contact', 'phone number', 'phone'], 4, '');
            $country = self::getCell($row, $headerMap, ['country'], 5, 'Philippines');
            $city    = self::getCell($row, $headerMap, ['city'], 7, '');
            $street  = self::getCell($row, $headerMap, ['street'], 9, '');
            $postal  = self::getCell($row, $headerMap, ['postal code', 'postal'], 10, '');

            $amountRaw = self::getCell($row, $headerMap, ['amount'], 11, '100');
            $amount    = floatval(preg_replace('/[^0-9.]/', '', $amountRaw));
            if ($amount <= 0) {
                $amount = 100;
            }

            $giveTypeRaw = self::getCell($row, $headerMap, ['give type', 'give_type', 'type'], 12, 'once');
            $giveType    = str_contains(strtolower($giveTypeRaw), 'month') ? 'monthly' : 'once';

            $paymentMethodRaw = self::getCell($row, $headerMap, ['payment method', 'payment_method', 'payment'], 13, 'gcash');
            $paymentMethod    = strtolower($paymentMethodRaw) ?: 'gcash';

            $receiptRaw  = self::getCell($row, $headerMap, ['receipt', 'receipt uploaded'], 14, '');
            $receiptPath = self::parseReceiptCell($receiptRaw);

            // Clean leading quote if stored as '+63...'
            if ($phone && str_starts_with($phone, "'")) {
                $phone = ltrim($phone, "'");
            }

            if (empty($email) && empty($fname)) {
                continue;
            }

            // Check if record exists in database
            $exists = Donation::where('email', $email)
                ->where('amount', $amount)
                ->where('fname', $fname)
                ->exists();

            if ($exists) {
                $skipped++;
            } else {
                $data = [
                    'fname'          => $fname ?: 'Anonymous',
                    'lname'          => $lname,
                    'email'          => $email ?: 'donor@theparcfoundation.ph',
                    'country'        => $country ?: 'Philippines',
                    'city'           => $city,
                    'street'         => $street,
                    'postal'         => $postal,
                    'amount'         => $amount,
                    'give_type'      => $giveType,
                    'payment_method' => substr($paymentMethod, 0, 20),
                    'receipt_path'   => $receiptPath,
                ];

                if ($hasPhoneColumn) {
                    $data['phone'] = $phone;
                }

                Donation::create($data);
                $synced++;
            }
        }

        return ['synced' => $synced, 'skipped' => $skipped, 'total' => count($rows)];
    }

    /**
     * Sync Adoptions tab from Google Sheets into MySQL database.
     *
     * @return array Summary of synced, skipped, and total records.
     */
    public static function syncAdoptions(): array
    {
        $sheetId  = env('GOOGLE_SHEET_ADOPTIONS_ID') ?: (env('GOOGLE_SHEET_DONATIONS_ID') ?: '1INqiJMGp8JZQzRksA3WPgCPVAMPkJgKiqbzN7iGkPIk');
        $sheetTab = env('GOOGLE_SHEET_ADOPTIONS_TAB') ?: 'Adoptions';

        $rows = self::fetchRows($sheetId, $sheetTab);
        if (count($rows) <= 1) {
            return ['synced' => 0, 'skipped' => 0, 'total' => 0];
        }

        $header = array_shift($rows);
        $headerMap = self::buildHeaderMap($header);

        $synced = 0;
        $skipped = 0;

        foreach ($rows as $row) {
            if (empty($row) || count($row) < 3) {
                continue;
            }

            $fname   = self::getCell($row, $headerMap, ['first name', 'fname'], 1, 'Anonymous');
            $lname   = self::getCell($row, $headerMap, ['last name', 'lname'], 2, '');
            $email   = self::getCell($row, $headerMap, ['email', 'email address'], 3, '');
            $country = self::getCell($row, $headerMap, ['country'], 5, 'Philippines');
            $city    = self::getCell($row, $headerMap, ['city'], 7, '');
            $street  = self::getCell($row, $headerMap, ['street'], 9, '');
            $postal  = self::getCell($row, $headerMap, ['postal code', 'postal'], 10, '');
            $package = self::getCell($row, $headerMap, ['package', 'package / tier', 'tier'], 11, 'Individual Scholar');

            $amountRaw = self::getCell($row, $headerMap, ['amount'], 12, '500');
            $amount    = floatval(preg_replace('/[^0-9.]/', '', $amountRaw));
            if ($amount <= 0) {
                $amount = 500;
            }

            $receiptRaw  = self::getCell($row, $headerMap, ['receipt uploaded', 'receipt'], 14, '');
            $receiptPath = self::parseReceiptCell($receiptRaw);

            if (empty($email) && empty($fname)) {
                continue;
            }

            $exists = Adoption::where('email', $email)
                ->where('fname', $fname)
                ->where('amount', $amount)
                ->exists();

            if ($exists) {
                $skipped++;
            } else {
                Adoption::create([
                    'fname'        => $fname ?: 'Anonymous',
                    'lname'        => $lname,
                    'email'        => $email ?: 'adopter@theparcfoundation.ph',
                    'country'      => $country ?: 'Philippines',
                    'street'       => $street,
                    'city'         => $city,
                    'postal'       => $postal,
                    'package'      => $package ?: 'Individual Scholar',
                    'amount'       => $amount,
                    'receipt_path' => $receiptPath,
                ]);
                $synced++;
            }
        }

        return ['synced' => $synced, 'skipped' => $skipped, 'total' => count($rows)];
    }

    /**
     * Sync Contacts_Inquiry tab from Google Sheets into MySQL database.
     *
     * @return array Summary of synced, skipped, and total records.
     */
    public static function syncContacts(): array
    {
        $sheetId  = env('GOOGLE_SHEET_CONTACTS_ID') ?: (env('GOOGLE_SHEET_DONATIONS_ID') ?: '1INqiJMGp8JZQzRksA3WPgCPVAMPkJgKiqbzN7iGkPIk');
        $sheetTab = env('GOOGLE_SHEET_CONTACTS_TAB') ?: 'Contacts_Inquiry';

        $rows = self::fetchRows($sheetId, $sheetTab);
        if (count($rows) <= 1) {
            return ['synced' => 0, 'skipped' => 0, 'total' => 0];
        }

        $header = array_shift($rows);
        $headerMap = self::buildHeaderMap($header);

        $synced = 0;
        $skipped = 0;

        foreach ($rows as $row) {
            if (empty($row) || count($row) < 3) {
                continue;
            }

            $fname   = self::getCell($row, $headerMap, ['first name', 'fname'], 0, 'Visitor');
            $lname   = self::getCell($row, $headerMap, ['last name', 'lname'], 1, '');
            $email   = self::getCell($row, $headerMap, ['email address', 'email'], 2, '');
            $phone   = self::getCell($row, $headerMap, ['phone number', 'phone'], 3, '');
            $subject = self::getCell($row, $headerMap, ['subject / inquiry type', 'subject'], 4, 'General Inquiry');
            $message = self::getCell($row, $headerMap, ['message'], 5, '');

            if (empty($email) && empty($message)) {
                continue;
            }

            if (class_exists(\App\Models\ContactMessage::class)) {
                $exists = \App\Models\ContactMessage::where('email', $email)
                    ->where('first_name', $fname)
                    ->where('subject', $subject)
                    ->exists();

                if ($exists) {
                    $skipped++;
                } else {
                    \App\Models\ContactMessage::create([
                        'first_name' => $fname ?: 'Visitor',
                        'last_name'  => $lname,
                        'email'      => $email ?: 'inquiry@theparcfoundation.ph',
                        'phone'      => $phone,
                        'subject'    => $subject,
                        'message'    => $message ?: 'No message text provided.',
                    ]);
                    $synced++;
                }
            }
        }

        return ['synced' => $synced, 'skipped' => $skipped, 'total' => count($rows)];
    }

    /**
     * Fetch sheet rows via API with CSV fallback.
     */
    private static function fetchRows(string $sheetId, string $sheetTab): array
    {
        $rows = GoogleSheetsExporter::readTab($sheetId, $sheetTab);
        if (!empty($rows)) {
            return $rows;
        }

        // CSV Fallback URL
        $csvUrl = "https://docs.google.com/spreadsheets/d/{$sheetId}/gviz/tq?tqx=out:csv&sheet=" . urlencode($sheetTab);
        try {
            $context = stream_context_create([
                'http' => [
                    'timeout' => 5,
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'
                ]
            ]);
            $csvData = @file_get_contents($csvUrl, false, $context);
            if ($csvData) {
                $parsedRows = [];
                $lines = explode("\n", $csvData);
                foreach ($lines as $line) {
                    $line = trim($line);
                    if ($line !== '') {
                        $parsedRows[] = str_getcsv($line);
                    }
                }
                return $parsedRows;
            }
        } catch (\Throwable $e) {
            // Ignore error
        }

        return [];
    }
}


