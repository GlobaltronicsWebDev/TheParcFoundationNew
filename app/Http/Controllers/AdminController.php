<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Donation;
use App\Models\Adoption;
use App\Models\NewsletterSubscriber;
use App\Models\ContactMessage;
use App\Helpers\GoogleSheetsImporter;

class AdminController extends Controller
{
    /**
     * Show Admin Login Page.
     */
    public function loginForm()
    {
        if (session('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    /**
     * Authenticate Admin User.
     */
    public function login(Request $request)
    {
        $password = $request->input('password');
        $validPassword = env('ADMIN_PASSWORD', 'parc_admin_2026');

        if ($password === $validPassword) {
            session(['admin_authenticated' => true]);
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!');
        }

        return back()->with('error', 'Invalid admin password. Please try again.');
    }

    /**
     * Logout Admin User.
     */
    public function logout()
    {
        session()->forget('admin_authenticated');
        return redirect()->route('admin.login')->with('info', 'Logged out successfully.');
    }

    /**
     * Render Admin Dashboard Page.
     */
    public function dashboard()
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $totalDonationAmount = Donation::sum('amount');
        $totalAdoptionAmount = Adoption::sum('amount');
        $totalRaised = $totalDonationAmount + $totalAdoptionAmount;

        $donationCount = Donation::count();
        $adoptionCount = Adoption::count();
        $subscriberCount = NewsletterSubscriber::count();
        $hasContactTable = Schema::hasTable('contact_messages');
        $contactCount = $hasContactTable ? ContactMessage::count() : 0;

        $donations = Donation::orderBy('id', 'desc')->take(200)->get();
        $adoptions = Adoption::orderBy('id', 'desc')->take(200)->get();
        $subscribers = NewsletterSubscriber::orderBy('id', 'desc')->take(200)->get();
        $contacts = $hasContactTable ? ContactMessage::orderBy('id', 'desc')->take(200)->get() : collect();

        return view('admin.dashboard', compact(
            'totalRaised',
            'totalDonationAmount',
            'totalAdoptionAmount',
            'donationCount',
            'adoptionCount',
            'subscriberCount',
            'contactCount',
            'donations',
            'adoptions',
            'subscribers',
            'contacts'
        ));
    }

    /**
     * Trigger Google Sheets Synchronization.
     */
    public function syncSheets()
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        try {
            $donationResult = GoogleSheetsImporter::syncDonations();
            $adoptionResult = GoogleSheetsImporter::syncAdoptions();
            $contactResult  = Schema::hasTable('contact_messages') ? GoogleSheetsImporter::syncContacts() : ['synced' => 0];

            $msg = sprintf(
                'Google Sheets Sync Complete! Donations: %d new. Adoptions: %d new. Contact Messages: %d new.',
                $donationResult['synced'],
                $adoptionResult['synced'],
                $contactResult['synced']
            );

            return redirect()->route('admin.dashboard')->with('success', $msg);
        } catch (\Throwable $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Sync failed: ' . $e->getMessage());
        }
    }

    /**
     * Reset all database table records and auto-increment IDs.
     */
    public function resetData()
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            Donation::truncate();
            Adoption::truncate();
            NewsletterSubscriber::truncate();
            if (Schema::hasTable('contact_messages')) {
                ContactMessage::truncate();
            }

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return redirect()->route('admin.dashboard')->with('success', 'All database tables have been reset successfully! IDs reset to #1.');
        } catch (\Throwable $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Reset failed: ' . $e->getMessage());
        }
    }
}
