<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Adoption;
use App\Models\NewsletterSubscriber;
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

        $donations = Donation::orderBy('id', 'desc')->take(200)->get();
        $adoptions = Adoption::orderBy('id', 'desc')->take(200)->get();
        $subscribers = NewsletterSubscriber::orderBy('id', 'desc')->take(200)->get();

        return view('admin.dashboard', compact(
            'totalRaised',
            'totalDonationAmount',
            'totalAdoptionAmount',
            'donationCount',
            'adoptionCount',
            'subscriberCount',
            'donations',
            'adoptions',
            'subscribers'
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

            $msg = sprintf(
                'Google Sheets Sync Complete! Donations: %d new, %d existing. Adoptions: %d new, %d existing.',
                $donationResult['synced'],
                $donationResult['skipped'],
                $adoptionResult['synced'],
                $adoptionResult['skipped']
            );

            return redirect()->route('admin.dashboard')->with('success', $msg);
        } catch (\Throwable $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Sync failed: ' . $e->getMessage());
        }
    }
}
