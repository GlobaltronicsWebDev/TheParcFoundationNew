<?php

namespace App\Helpers;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class GoogleSheetsExporter
{
    /**
     * Append a single row to a Google Sheet.
     *
     * @param  string  $spreadsheetId  The Google Sheet ID (from the URL)
     * @param  string  $tab            The sheet tab name (e.g. "Donations")
     * @param  array   $headers        Column header labels (written only if sheet is empty)
     * @param  array   $row            The data row to append (indexed array of values)
     * @return void
     *
     * @throws \Exception on API or credential errors
     */
    public static function append(
        string $spreadsheetId,
        string $tab,
        array  $headers,
        array  $row
    ): void {
        $credentialsPath = base_path(env('GOOGLE_SHEETS_CREDENTIALS', 'storage/app/google-service-account.json'));

        if (!file_exists($credentialsPath)) {
            throw new \RuntimeException(
                "Google Service Account credentials not found at: {$credentialsPath}. " .
                "Please place your JSON key file there and update GOOGLE_SHEETS_CREDENTIALS in .env"
            );
        }

        // ── Authenticate ──────────────────────────────────────────────────
        $client = new Client();
        $client->setApplicationName('PARC Foundation');
        $client->setScopes([Sheets::SPREADSHEETS]);
        $client->setAuthConfig($credentialsPath);
        $client->setAccessType('offline');

        $service = new Sheets($client);

        // ── Check if headers need to be written (empty sheet) ─────────────
        $range    = "{$tab}!A1:Z1";
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $existing = $response->getValues();

        if (empty($existing)) {
            // Sheet is blank — write the header row first
            $headerBody = new ValueRange(['values' => [$headers]]);
            $service->spreadsheets_values->update(
                $spreadsheetId,
                "{$tab}!A1",
                $headerBody,
                ['valueInputOption' => 'RAW']
            );
        }

        // ── Append the data row ───────────────────────────────────────────
        $body = new ValueRange(['values' => [$row]]);
        $service->spreadsheets_values->append(
            $spreadsheetId,
            "{$tab}!A1",
            $body,
            [
                'valueInputOption'  => 'USER_ENTERED',  // Lets Google parse dates/numbers
                'insertDataOption'  => 'INSERT_ROWS',   // Always add a new row; never overwrite
            ]
        );
    }
}
