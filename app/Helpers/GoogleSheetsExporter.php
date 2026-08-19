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

        // Check if file exists and has valid json
        $shouldWrite = false;
        if (!file_exists($credentialsPath)) {
            $shouldWrite = true;
        } else {
            $content = file_get_contents($credentialsPath);
            if (empty($content) || strpos($content, 'BEGIN PRIVATE KEY') === false || strpos($content, '\n') !== false) {
                $shouldWrite = true;
            }
        }

        if ($shouldWrite) {
            $dir = dirname($credentialsPath);
            if (!is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }
            $jsonContent = "{\n" .
                '  "type": "service_account",' . "\n" .
                '  "project_id": "spheric-hawk-503003-u8",' . "\n" .
                '  "private_key_id": "640ae5efc019fa1d180bb6ae60be13443c8b0d00",' . "\n" .
                '  "private_key": "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDcljsBjQCIijm7\nXylZ80+S2tfl8qkGWxIsZGfOV63GQoUMtipCApmGqmFs1cvdDF0CdN30M8XxcDZt\nOAadg/YRhCFyuKg6lfPe7m2znBwB/iVxj80vRqb/QP1CtnInp5gRqqUjcg2YIFKG\ntExosHlGXmFsNUkQQxeVeOjrst5PZ7h1c/VRozLbrA9H9uReOU9JsQ0IPK3iKdux\ncb94LDrzf+W5R6hnHZuN+vztckKZwWvlaWC5gUISawLhbIsW4J34KD1rFvZhPyz4\nxrTgm6A8z8MFQP2Qx7IUp+GRNNDsPiC0pS2KcxwLqPblDxglyKMRkHoEkLmqK+dZ\nxZC9IzxrAgMBAAECggEAAMRQRIicybIP/PvvNQiuAaOGIEla12f7T7EyVTAj2APE\n2k710FCZql4ERFsX6tb5/yIF4C1KkQoj/kw1Za3JmLT+DXE2kIGTR/afO1fIbHoE\nNPlcLBURoTiKHjBr2YHGew/opA9nnFxHEoB6StuLiGLtRsbb+qpTtil7RyUniwdz\nyh+J/+JpJq0O0ADT0RNlSZXGPxmC/XLNCYJUf7iRRdzs67Lda3qNaJX+m5x38UpF\n+PTPWdWNjoTteVPYgg0mPJMbH1fMcH9B9biCf4KnzV4b8Oqybv1DMcBK/3VnrV9F\n8wJUemla3EvVJV8dr0PLFJOObZwfLxE5FYd3BmDHfQKBgQD/fcdBkaBOR5gtNay3\n8nafsWUQr8LODEK836XMk8rMmMz6QsUusG4HTr4myckvX8w6R5hTOiZlcyneTAwz\nBiWCRsyr3FYg5Y1vq17eTKs6pN/mERdrD/I2XMpPiD261bUS9W7MAt/ROHkghw7L\nbnjFsBykI9ptu8CBJkEqq+H31QKBgQDdBqlhb8XNclJB4sC7OwTCV/5FJf9MT31U\nB+FJ6nxnsM7hBgNfS/jty2zvTVYNsTHDDjyTa/yZf2+YB9CEYITZtXegCPFk+bGZ\nvr0s4ytpIC7QYJ/ooEM0ii+Ate0CHPVPWWXGYn7y0yg5ZELnuTWiKX3xaD2NE5qb\n2iI1LcDDPwKBgFywZPmEu4OqtaqxLlgNvrtwwBmtqh7Wk9+xw5TUiV5wkOy6DI9D\nsqc0CghIbJSjTJRYJQsMraFghm//Zu2b7T+2L8qpxRVqMkWxBlnftr8v0YrF6JkO\nz/Co+TyhUMPXhDm8kNWytUBSHJ+QX+2txmLx4XIrD7N/yfcQydORSAmBAoGBAKL0\nTGD4BT+pL5g/05S2uJWIRoE4uHbMjDwt6x2R8dKI+p3Qzx+tZYP8XP45aF6D64pB\nrsuJ7BxHZkESUdunRYs1TVMCBOdLaHNPuy2i9th0z871zi+2KJZN4yPj/S93piyw\nXmbbK3lf0OIvV1x8olxCdwZKskaW04BgXKQUbXAFAoGAfIsRNaYz3TU6tXSv98Jb\n52BjBDbfXGZtk6GuB1hCbfiNy9QvC2NOef38DBZuB9yNN4d2LFsjbITx4L75kju/\nS+K6CrWNp5kJPoQ74pT2SUjc8X6Yuwj20ptInEhtlxnWb8lLvS0VPqBK09YdyN19\nxAjjWIvuUPBIlsUNdytVVx0=\n-----END PRIVATE KEY-----\n",' . "\n" .
                '  "client_email": "parc-backend@spheric-hawk-503003-u8.iam.gserviceaccount.com",' . "\n" .
                '  "client_id": "111496643088927491306",' . "\n" .
                '  "auth_uri": "https://accounts.google.com/o/oauth2/auth",' . "\n" .
                '  "token_uri": "https://oauth2.googleapis.com/token",' . "\n" .
                '  "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",' . "\n" .
                '  "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/parc-backend%40spheric-hawk-503003-u8.iam.gserviceaccount.com",' . "\n" .
                '  "universe_domain": "googleapis.com"' . "\n" .
                '}';
            @file_put_contents($credentialsPath, $jsonContent);
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

        $tabRange = str_starts_with($tab, "'") ? "{$tab}!A1" : "'{$tab}'!A1";

        // ── Write / Sync Header Row (A1) ──────────────────────────────────
        $headerBody = new ValueRange(['values' => [$headers]]);
        $service->spreadsheets_values->update(
            $spreadsheetId,
            $tabRange,
            $headerBody,
            ['valueInputOption' => 'USER_ENTERED']
        );

        // ── Append the data row ───────────────────────────────────────────
        $body = new ValueRange(['values' => [$row]]);
        $service->spreadsheets_values->append(
            $spreadsheetId,
            $tabRange,
            $body,
            [
                'valueInputOption'  => 'USER_ENTERED',  // Lets Google parse dates/numbers
                'insertDataOption'  => 'INSERT_ROWS',   // Always add a new row; never overwrite
            ]
        );
    }
}
