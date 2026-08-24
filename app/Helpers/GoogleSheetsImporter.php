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

    /**
     * Sync Contacts_Inquiry tab from Google Sheets into MySQL database.
     *
     * @return array Summary of synced, skipped, and total records.
     */
    public static function syncContacts(): array
    {
        $sheetId  = env('GOOGLE_SHEET_CONTACTS_ID') ?: (env('GOOGLE_SHEET_DONATIONS_ID') ?: '1INqiJMGp8JZQzRksA3WPgCPVAMPkJgKiqbzN7iGkPIk');
        $sheetTab = env('GOOGLE_SHEET_CONTACTS_TAB') ?: 'Contacts_Inquiry';

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

            // Expected headers:
            // 0: First Name, 1: Last Name, 2: Email Address,
            // 3: Phone Number, 4: Subject / Inquiry Type, 5: Message, 6: Date Submitted

            $fname   = trim($row[0] ?? 'Visitor');
            $lname   = trim($row[1] ?? '');
            $email   = trim($row[2] ?? '');
            $phone   = trim($row[3] ?? '');
            $subject = trim($row[4] ?? 'General Inquiry');
            $message = trim($row[5] ?? '');

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
}
