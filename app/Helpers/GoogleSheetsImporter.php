<?php

namespace App\Helpers;

use App\Models\Donation;
use App\Models\Adoption;

class GoogleSheetsImporter
{
    /**
     * Sync Donations tab from Google Sheets into MySQL database.
     *
     * @return array Summary of synced, skipped, and total records.
     */
    public static function syncDonations(): array
    {
        $sheetId  = env('GOOGLE_SHEET_DONATIONS_ID') ?: '1INqiJMGp8JZQzRksA3WPgCPVAMPkJgKiqbzN7iGkPIk';
        $sheetTab = env('GOOGLE_SHEET_DONATIONS_TAB') ?: 'Donations';

        $rows = GoogleSheetsExporter::readTab($sheetId, $sheetTab);
        if (count($rows) <= 1) {
            return ['synced' => 0, 'skipped' => 0, 'total' => 0];
        }

        // Header row is index 0
        $header = array_shift($rows);

        $synced = 0;
        $skipped = 0;

        foreach ($rows as $row) {
            if (empty($row) || count($row) < 3) {
                continue;
            }

            $email  = trim($row[3] ?? '');
            $amount = floatval(preg_replace('/[^0-9.]/', '', $row[10] ?? '0'));
            $fname  = trim($row[1] ?? 'Anonymous');
            $lname  = trim($row[2] ?? '');

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
                Donation::create([
                    'fname' => $fname ?: 'Anonymous',
                    'lname' => $lname,
                    'email' => $email ?: 'donor@theparcfoundation.ph',
                    'country' => $row[4] ?? 'Philippines',
                    'city' => $row[6] ?? '',
                    'street' => $row[8] ?? '',
                    'postal' => $row[9] ?? '',
                    'amount' => $amount ?: 100,
                    'give_type' => $row[11] ?? 'once',
                    'payment_method' => strtolower($row[12] ?? 'gcash'),
                    'receipt_path' => $row[13] ?? null,
                ]);
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
        $sheetId  = env('GOOGLE_SHEET_ADOPTIONS_ID') ?: '1INqiJMGp8JZQzRksA3WPgCPVAMPkJgKiqbzN7iGkPIk';
        $sheetTab = env('GOOGLE_SHEET_ADOPTIONS_TAB') ?: 'Adoptions';

        $rows = GoogleSheetsExporter::readTab($sheetId, $sheetTab);
        if (count($rows) <= 1) {
            return ['synced' => 0, 'skipped' => 0, 'total' => 0];
        }

        $header = array_shift($rows);

        $synced = 0;
        $skipped = 0;

        foreach ($rows as $row) {
            if (empty($row) || count($row) < 3) {
                continue;
            }

            $fname   = trim($row[1] ?? 'Anonymous');
            $lname   = trim($row[2] ?? '');
            $email   = trim($row[3] ?? '');
            $package = trim($row[9] ?? 'Scholar Tier');
            $amount  = floatval(preg_replace('/[^0-9.]/', '', $row[10] ?? '0'));

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
                    'fname' => $fname ?: 'Anonymous',
                    'lname' => $lname,
                    'email' => $email ?: 'adopter@theparcfoundation.ph',
                    'country' => $row[4] ?? 'Philippines',
                    'street' => $row[7] ?? '',
                    'city' => $row[5] ?? '',
                    'postal' => $row[8] ?? '',
                    'package' => $package ?: 'Individual Scholar',
                    'amount' => $amount ?: 500,
                    'receipt_path' => $row[12] ?? null,
                ]);
                $synced++;
            }
        }

        return ['synced' => $synced, 'skipped' => $skipped, 'total' => count($rows)];
    }
}
