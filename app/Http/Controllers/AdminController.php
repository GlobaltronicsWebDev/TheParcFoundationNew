<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Donation;
use App\Models\Adoption;
use App\Models\NewsletterSubscriber;
use App\Models\ContactMessage;
use App\Models\NewsArticle;
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

        try {
            $totalDonationAmount = Donation::sum('amount');
            $totalAdoptionAmount = Adoption::sum('amount');
            $totalRaised = $totalDonationAmount + $totalAdoptionAmount;

            $donationCount = Donation::count();
            $adoptionCount = Adoption::count();
            $hasContactTable = Schema::hasTable('contact_messages');
            $contactCount = $hasContactTable ? ContactMessage::count() : 0;

            $donations = Donation::orderBy('id', 'desc')->take(200)->get();
            $adoptions = Adoption::orderBy('id', 'desc')->take(200)->get();
            $hasNewsTable = Schema::hasTable('news_articles');
            $newsArticles = $hasNewsTable ? NewsArticle::orderBy('is_featured', 'desc')->orderBy('published_date', 'desc')->orderBy('id', 'desc')->get() : collect();
            $newsCount = count($newsArticles);
        } catch (\Throwable $e) {
            $totalRaised = 0;
            $totalDonationAmount = 0;
            $totalAdoptionAmount = 0;
            $donationCount = 0;
            $adoptionCount = 0;
            $contactCount = 0;
            $newsCount = 0;
            $donations = collect();
            $adoptions = collect();
            $contacts = collect();
            $newsArticles = collect();
            session()->flash('error', 'Database notice: Unable to reach database server. If running locally, please ensure MySQL is started.');
        }

        return view('admin.dashboard', compact(
            'totalRaised',
            'totalDonationAmount',
            'totalAdoptionAmount',
            'donationCount',
            'adoptionCount',
            'contactCount',
            'newsCount',
            'donations',
            'adoptions',
            'contacts',
            'newsArticles'
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

    /**
     * Delete a single donation record.
     */
    public function deleteDonation($id)
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $donation = Donation::find($id);
        if ($donation) {
            $donation->delete();
            return redirect()->back()->with('success', 'Donation #' . $id . ' deleted successfully.');
        }

        return redirect()->back()->with('error', 'Donation record not found.');
    }

    /**
     * Delete a single adoption record.
     */
    public function deleteAdoption($id)
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $adoption = Adoption::find($id);
        if ($adoption) {
            $adoption->delete();
            return redirect()->back()->with('success', 'Adoption #' . $id . ' deleted successfully.');
        }

        return redirect()->back()->with('error', 'Adoption record not found.');
    }

    /**
     * Delete a single contact message record.
     */
    public function deleteContact($id)
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        if (Schema::hasTable('contact_messages')) {
            $contact = ContactMessage::find($id);
            if ($contact) {
                $contact->delete();
                return redirect()->back()->with('success', 'Contact message #' . $id . ' deleted successfully.');
            }
        }

        return redirect()->back()->with('error', 'Contact message not found.');
    }

    /**
     * Delete a single newsletter subscriber record.
     */
    public function deleteSubscriber($id)
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $subscriber = NewsletterSubscriber::find($id);
        if ($subscriber) {
            $subscriber->delete();
            return redirect()->back()->with('success', 'Subscriber #' . $id . ' deleted successfully.');
        }

        return redirect()->back()->with('error', 'Subscriber record not found.');
    }

    /**
     * Store a newly created News Article via CMS.
     */
    public function storeNews(Request $request)
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'category'       => 'nullable|string|max:100',
            'published_date' => 'nullable|date',
            'youtube_url'    => 'nullable|url|max:500',
            'external_link'  => 'nullable|url|max:500',
            'excerpt'        => 'nullable|string|max:1000',
            'content'        => 'nullable|string',
            'is_featured'    => 'nullable|boolean',
            'status'         => 'nullable|in:published,draft',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        $data = [
            'title'          => $validated['title'],
            'category'       => $validated['category'] ?: 'News & Updates',
            'published_date' => $validated['published_date'] ?: now()->toDateString(),
            'youtube_url'    => $validated['youtube_url'] ?? null,
            'external_link'  => $validated['external_link'] ?? null,
            'excerpt'        => $validated['excerpt'] ?? null,
            'content'        => $validated['content'] ?? null,
            'is_featured'    => $request->boolean('is_featured'),
            'status'         => $validated['status'] ?? 'published',
        ];

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $filename = time() . '_' . \Illuminate\Support\Str::random(16) . '.' . $ext;
            
            $dir1 = public_path('assets/image/NEWS');
            $dir2 = public_path('storage/news');
            if (!file_exists($dir1)) { @mkdir($dir1, 0755, true); }
            if (!file_exists($dir2)) { @mkdir($dir2, 0755, true); }

            $file->move($dir1, $filename);
            @copy($dir1 . '/' . $filename, $dir2 . '/' . $filename);

            $data['image_path'] = 'assets/image/NEWS/' . $filename;
        }

        // If marked featured, remove featured status from others
        if (!empty($data['is_featured'])) {
            NewsArticle::where('is_featured', true)->update(['is_featured' => false]);
        }

        NewsArticle::create($data);

        return redirect()->route('admin.dashboard', ['#news-pane'])->with('success', 'News article published successfully!');
    }

    /**
     * Update an existing News Article.
     */
    public function updateNews(Request $request, $id)
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $article = NewsArticle::findOrFail($id);

        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'category'       => 'nullable|string|max:100',
            'published_date' => 'nullable|date',
            'youtube_url'    => 'nullable|url|max:500',
            'external_link'  => 'nullable|url|max:500',
            'excerpt'        => 'nullable|string|max:1000',
            'content'        => 'nullable|string',
            'is_featured'    => 'nullable|boolean',
            'status'         => 'nullable|in:published,draft',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        $article->title          = $validated['title'];
        $article->category       = $validated['category'] ?: 'News & Updates';
        $article->published_date = $validated['published_date'] ?: $article->published_date;
        $article->youtube_url    = $validated['youtube_url'] ?? null;
        $article->external_link  = $validated['external_link'] ?? null;
        $article->excerpt        = $validated['excerpt'] ?? null;
        $article->content        = $validated['content'] ?? null;
        $article->status         = $validated['status'] ?? 'published';
        
        $isFeatured = $request->boolean('is_featured');
        if ($isFeatured && !$article->is_featured) {
            NewsArticle::where('id', '!=', $article->id)->where('is_featured', true)->update(['is_featured' => false]);
        }
        $article->is_featured = $isFeatured;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $filename = time() . '_' . \Illuminate\Support\Str::random(16) . '.' . $ext;
            
            $dir1 = public_path('assets/image/NEWS');
            $dir2 = public_path('storage/news');
            if (!file_exists($dir1)) { @mkdir($dir1, 0755, true); }
            if (!file_exists($dir2)) { @mkdir($dir2, 0755, true); }

            $file->move($dir1, $filename);
            @copy($dir1 . '/' . $filename, $dir2 . '/' . $filename);

            $article->image_path = 'assets/image/NEWS/' . $filename;
        }

        $article->save();

        return redirect()->route('admin.dashboard', ['#news-pane'])->with('success', 'News article updated successfully!');
    }

    /**
     * Delete a News Article.
     */
    public function deleteNews($id)
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $article = NewsArticle::find($id);
        if ($article) {
            $article->delete();
            return redirect()->back()->with('success', 'News article deleted successfully.');
        }

        return redirect()->back()->with('error', 'Article not found.');
    }
}
