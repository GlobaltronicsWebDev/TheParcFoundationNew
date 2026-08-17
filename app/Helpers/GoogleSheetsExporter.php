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
        $credentialsRel  = env('GOOGLE_SHEETS_CREDENTIALS') ?: 'storage/app/spheric-hawk-503003-u8-640ae5efc019.json';
        $credentialsPath = base_path($credentialsRel);

        if (!file_exists($credentialsPath)) {
            // Auto-generate credentials JSON file if missing on production host
            $defaultJsonBase64 = 'ewogICJ0eXBlIjogInNlcnZpY2VfYWNjb3VudCIsCiAgInByb2plY3RfaWQiOiAic3BoZXJpYy1oYXdrLTUwMzAwMy11OCIsCiAgInByaXZhdGVfa2V5X2lkIjogIjY0MGFlNWVmYzAxOWZhMWQxODBiYjZhZTYwYmUxMzQ0M2M4YjBkMDAiLAogICJwcml2YXRlX2tleSI6ICItLS0tLUJFR0lOIFBSSVZBVEUgS0VZLS0tLS1cbk1JSUV2UUlCQURBTkJna3Foa2lHOXcwQkFRRUZBQVNDQktjd2dnU2pBZ0VBQW9JQkFRRGNsanNCalFDSWlqbTdcblh5bFo4MCtTMnRmbDhxa0dXeElzWkdmT1Y2M0dRb1VNdGlwQ0FwbUdxbUZzMWN2ZERGMENkTjMwTThYeGNEWnRcbk9BYWRnL1lSaENGeXVLZzZsZlBlN20yem5Cd0IvaVZ4ajgwdlJxYi9RUDFDdG5JbnA1Z1JxcVVqY2cyWUlGS0dcbnRFeG9zSGxHWG1Gc05Va1FReGVWZU9qcnN0NVBaN2gxYy9WUm96TGJyQTlIOXVSZU9VOUpzUTBJUEszaUtkdXhcbmNiOTRMRHJ6ZitXNVI2aG5IWnVOK3Z6dGNrS1p3V3ZsYVdDNWdVSVNhd0xoYklzVzRKMzRLRDFyRnZaaFB5ejRcbnhyVGdtNkE4ejhNRlFQMlF4N0lVcCtHUk5ORHNQaUMwcFMyS2N4d0xxUGJsRHhnbHlLTVJrSG9Fa0xtcUsrZFpcbnhaQzlJenhyQWdNQkFBRUNnZ0VBQU1SUVJJaWN5YklQL1B2dk5RaXVBYU9HSUVsYTEyZjdUN0V5VlRBajJBUEVcbjJrNzEwRkNacWw0RVJGc1g2dGI1L3lJRjRDMUtrUW9qL2t3MVphM0ptTFQrRFhFMmtJR1RSL2FmTzFmSWJIb0Vcbk5QbGNMQlVSb1RpS0hqQnIyWUhHZXcvb3BBOW5uRnhIRW9CNlN0dUxpR0x0UnNiYitxcFR0aWw3UnlVbml3ZHpcbnloK0ovK0pwSnEwTzBBRFQwUk5sU1pYR1B4bUMvWExOQ1lKVWY3aVJSZHpzNjdMZGEzcU5hSlgrbTV4MzhVcEZcbitQVFBXZFdOam9UdGVWUFlnZzBtUEpNYkgxZk1jSDlCOWJpQ2Y0S256VjRiOE9xeWJ2MURNY0JLLzNWbnJWOUZcbjh3SlVlbWxhM3E2VkpWOGRyMFBMRkpPT2Jad2ZMeEU1RllkM3B0REhmUUtCZ1FEL2ZjZEJrYUJPUjVndE5heTNcbjhuYWZzV1VRcjhMT0RFSzgzNlhNazhyTW1NejZRc1V1c0c0SFRyNG15Y2t2WDh3NlI1aFRPaVpsY3luZVRBd3pcbkJpV0NSc3lyM3ZZZzVZMXZxMTdlVEtzNnBOL21FUmRyRC9JMlhNcFBpRDI2MWJVUzlXN01BdC9ST0hrZ2h3N0xcbmJuakZzQnlrSTlwdHU4Q0JKa0VxcStIMzFRS0JnUURkQnFsaGI4WE5jbEpCNHNDN093VENWLzVGSmY5TVQzMVVcbkIrRko2bnhuc003aEJnTmZTL2p0eTJ6dlRWWU5zVEhERGp5VGEveVpmMitZQjlDRVlJVFp0WGVnQ1BGaytiR1pcbnZyMHM0eXRwSUM3UVlKL29vRU0waWkrQXRlMENIUFZQV1dYR1luN3kweWc1WkVMbnVUV2lLWDN4YUQyTkU1cWJcbjJpSTFMY0REUHdLQmdGeXdaUG1FdTRPcXRhcXhMbGdOdnJ0d3dCbXRxaDdXazkreHc1VFVpVjV3a095NkRJOURcbnNxYzBDZ2hJYkpTalRKUllKUXNNcmFGZ2htLy9adTJiN1QrMkw4cXB4UlZxTWtXeEJsbmZ0cjh2MFlyRjZKa09cbnovQ28rVHloVU1QWGhEbThrTld5dFVCU0hKK1FYKzJ0eG1MeDRYSXJEN04veWZjUXlkT1JTQW1CQW9HQkFLTDBcblRHRDRCVCtwTDVnLzA1UzJ1SldJUm9FNHVIYk1qRHd0NngyUjhkS0krcDNRengrdFpZUDhYUDQ1YUY2RDY0cEJcbnJzdUo3QnhIWmtFU1VkdW5SWXMxVFZNQ0JPZExhSE5QdXkyaTl0aDB6ODcxemkrMktKWk40eVBqL1M5M3BpeXdcblhtYmJLM2xmME9JdlYxeDhvbHhDZHdaS3NrYVcwNEJnWEtRVWJYQUZBb0dBZklzUk5hWXozVFU2dFhTdjk4SmJcbjUyQmpCRGJmWEdadGs2R3VCMWhDYmZpTnk5UXZDMk5PZWYzOERCWnVCOXlOTjRkMkxGc2piSVR4NEw3NWtqdS9cblMrSzZDcldOcDVrSlBvUTc0cFQyU1VqYzhYNll1d2oyMHB0SW5FaHRseG5XYjhsTHZTMFZQcUJLMDlZZHlOMTlcbnhBampXSXZ1VVBCSWxzVU5keXRWVngwPVxuLS0tLS1FTkQgUFJJVkFURSBLRVktLS0tLVxuIiwKICAiY2xpZW50X2VtYWlsIjogInBhcmMtYmFja2VuZEBzcGhlcmljLWhhd2stNTAzMDAzLXU4LmlhbS5nc2VydmljZWFjY291bnQuY29tIiwKICAiY2xpZW50X2lkIjogIjExMTQ5NjY0MzA4ODkyNzQ5MTMwNiIsCiAgImF1dGhfdXJpIjogImh0dHBzOi8vYWNjb3VudHMuZ29vZ2xlLmNvbS9vL29hdXRoMi9hdXRoIiwKICAidG9rZW5fdXJpIjogImh0dHBzOi8vb2F1dGgyLmdvb2dsZWFwaXMuY29tL3Rva2VuIiwKICAiYXV0aF9wcm92aWRlcl94NTA5X2NlcnRfdXJsIjogImh0dHBzOi8vd3d3Lmdvb2dsZWFwaXMuY29tL29hdXRoMi92MS9jZXJ0cyIsCiAgImNsaWVudF94NTA5X2NlcnRfdXJsIjogImh0dHBzOi8vd3d3Lmdvb2dsZWFwaXMuY29tL3JvYm90L3YxL21ldGFkYXRhL3g1MDkvcGFyYy1iYWNrZW5kJTQwc3BoZXJpYy1oYXdrLTUwMzAwMy11OC5pYW0uZ3NlcnZpY2VhY2NvdW50LmNvbSIsCiAgInVuaXZlcnNlX2RvbWFpbiI6ICJnb29nbGVhcGlzLmNvbSIKfQo=';
            $dir = dirname($credentialsPath);
            if (!is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }
            @file_put_contents($credentialsPath, base64_decode($defaultJsonBase64));
        }

        if (!file_exists($credentialsPath)) {
            throw new \RuntimeException(
                "Google Service Account credentials not found at: {$credentialsPath}."
            );
        }

        // ── Authenticate ──────────────────────────────────────────────────
        $client = new Client();
        $client->setApplicationName('PARC Foundation');
        $client->setScopes([Sheets::SPREADSHEETS]);
        $client->setAuthConfig($credentialsPath);
        $client->setAccessType('offline');

        $service = new Sheets($client);

        // ── Write / Sync Header Row (A1) ──────────────────────────────────
        $headerBody = new ValueRange(['values' => [$headers]]);
        $service->spreadsheets_values->update(
            $spreadsheetId,
            "{$tab}!A1",
            $headerBody,
            ['valueInputOption' => 'USER_ENTERED']
        );

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
