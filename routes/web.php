<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ContactController;

// ── Admin Dashboard Routes ─────────────────────────────────────────
Route::get('/admin', [AdminController::class, 'loginForm'])->name('admin.login');
Route::get('/admin/login', [AdminController::class, 'loginForm']);
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/sync-sheets', [AdminController::class, 'syncSheets'])->name('admin.sync');

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Welcome Page
Route::get('/welcome', function () {
    return view('welcome'); // resources/views/welcome.blade.php
})->name('welcome');

// New route for original.blade.php
Route::get('/home', function () {
    return view('original');
})->name('home');

// Donate Page
Route::get('/donate', [DonationController::class, 'create'])->name('donate');

// Adopt a Scholar Page
Route::get('/adopt', [AdoptionController::class, 'create'])->name('adopt');

// Simple route returning a view
Route::get('/news', function () {
    return view('news'); // make sure news.blade.php exists in resources/views
})->name('news');

// Simple route returning a view
Route::get('/events', function () {
    return view('events'); // make sure events.blade.php exists in resources/views
})->name('events');

// Events Video Gallery page
Route::get('/events-gallery', function () {
    return view('events-gallery');
})->name('events.gallery');

// About Us page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Simple route returning a view
Route::get('/donateform', function () {
    return view('donateform'); // make sure donateform.blade.php exists in resources/views
})->name('donateform');

// Simple route returning a view
Route::get('/adoptform', function () {
    return view('adoptform'); // make sure adoptform.blade.php exists in resources/views
})->name('adoptform');

Route::get('/donations', [DonationController::class, 'create'])->name('donations.create');
Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
Route::get('/donations/{id}/receipt', [DonationController::class, 'receipt'])->name('donations.receipt');
Route::get('/donations/{id}/download-receipt', [DonationController::class, 'downloadReceipt'])->name('donations.downloadReceipt');

Route::get('/adoptions', [AdoptionController::class, 'create'])->name('adoptions.create');
Route::post('/adoptions', [AdoptionController::class, 'store'])->name('adoptions.store');
Route::get('/adoptions/{id}/receipt', [AdoptionController::class, 'receipt'])->name('adoptions.receipt');
Route::get('/adoptions/{id}/download-receipt', [AdoptionController::class, 'downloadReceipt'])->name('adoptions.downloadReceipt');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::get('/contact', function () {
    return redirect()->route('contacts');
});
Route::post('/contacts/send', [ContactController::class, 'send'])->name('contacts.send');
Route::post('/contacts/send', [ContactController::class, 'send'])->middleware('throttle:6,1')->name('contacts.send');

// ── Stripe ──────────────────────────────────────────────────────────────────
// Create a PaymentIntent (called by Stripe.js on the frontend)
Route::post('/stripe/create-intent', [StripeController::class, 'createIntent'])->middleware('throttle:6,1')->name('stripe.createIntent');

// Stripe webhook – receives events from Stripe servers (CSRF excluded in bootstrap/app.php)
Route::post('/stripe/webhook', [StripeController::class, 'webhook'])->name('stripe.webhook');

// Helper function to verify admin secret key for administrative endpoints
$verifyAdminKey = function (\Illuminate\Http\Request $request) {
    $secret = env('ADMIN_SECRET_KEY', 'parc_admin_key_2026');
    if ($request->query('key') !== $secret) {
        abort(403, 'Unauthorized access: Invalid or missing secret key parameter.');
    }
};

// Route to trigger git pull automatically on Hostinger live server
Route::get('/deploy-git-pull', function (\Illuminate\Http\Request $request) use ($verifyAdminKey) {
    $verifyAdminKey($request);
    $output = [];
    $code = 0;
    exec('git pull origin main 2>&1', $output, $code);
    return response()->json([
        'success' => ($code === 0),
        'code'    => $code,
        'output'  => $output,
    ]);
});

// Debug endpoint to test Google Sheets append on live server
Route::get('/debug-sheets-append', function (\Illuminate\Http\Request $request) use ($verifyAdminKey) {
    $verifyAdminKey($request);
    try {
        $sheetId  = env('GOOGLE_SHEET_DONATIONS_ID') ?: '1INqiJMGp8JZQzRksA3WPgCPVAMPkJgKiqbzN7iGkPIk';
        $sheetTab = env('GOOGLE_SHEET_DONATIONS_TAB') ?: 'Donations';

        $headers = [
            'Donation ID', 'First Name', 'Last Name', 'Email',
            'Country', 'Province / Region', 'City', 'Barangay',
            'Street', 'Postal Code', 'Amount', 'Give Type',
            'Payment Method', 'Receipt', 'Date Submitted',
        ];

        $row = [
            '999', 'Debug', 'Test', 'debug@theparcfoundation.ph',
            'Philippines', 'Metro Manila', 'Quezon City', 'Batasan Hills',
            '123 Debug St', '1100', '500', 'once',
            'gcash', 'https://theparcfoundation.ph/receipts/test.jpg', date('n/j/Y')
        ];

        App\Helpers\GoogleSheetsExporter::append(
            spreadsheetId: $sheetId,
            tab:           $sheetTab,
            headers:       $headers,
            row:           $row
        );

        return response()->json(['success' => true, 'message' => 'Row 999 appended successfully to Google Sheet!']);
    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'error'   => $e->getMessage(),
            'file'    => $e->getFile(),
            'line'    => $e->getLine(),
            'trace'   => $e->getTraceAsString(),
        ]);
    }
});

// Route to view latest laravel.log lines on Hostinger live server
Route::get('/check-laravel-log', function (\Illuminate\Http\Request $request) use ($verifyAdminKey) {
    $verifyAdminKey($request);
    $logPath = storage_path('logs/laravel.log');
    if (!file_exists($logPath)) {
        return response()->json(['message' => 'No log file found at ' . $logPath]);
    }
    $content = file_get_contents($logPath);
    $lines = explode("\n", trim($content));
    $lastLines = array_slice($lines, -100);
    return response()->json([
        'total_lines' => count($lines),
        'last_100_lines' => implode("\n", $lastLines)
    ]);
});

// Route to reset Donation auto-increment ID back to 1
Route::get('/reset-donations-id', function (\Illuminate\Http\Request $request) use ($verifyAdminKey) {
    $verifyAdminKey($request);
    try {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\Donation::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return response()->json(['success' => true, 'message' => '✅ Donation IDs reset to 1 successfully! Next donation will be ID #1.']);
    } catch (\Throwable $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
});
