<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\WebsiteController::class, 'index'])->name('home');
Route::get('/about-us', [\App\Http\Controllers\WebsiteController::class, 'about'])->name('about');
Route::get('/campaigns', [\App\Http\Controllers\WebsiteController::class, 'campaigns'])->name('campaigns.index');
Route::get('/campaigns/{slug}', [\App\Http\Controllers\WebsiteController::class, 'campaignShow'])->name('campaigns.show');
Route::get('/blog', [\App\Http\Controllers\WebsiteController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [\App\Http\Controllers\WebsiteController::class, 'blogShow'])->name('blog.show');
Route::get('/contact-us', [\App\Http\Controllers\WebsiteController::class, 'contact'])->name('contact');
Route::post('/contact-us', [\App\Http\Controllers\WebsiteController::class, 'storeContact'])->name('contact.store');
Route::get('/volunteer', [\App\Http\Controllers\WebsiteController::class, 'volunteer'])->name('volunteer');
Route::post('/volunteer', [\App\Http\Controllers\WebsiteController::class, 'storeVolunteer'])->name('volunteer.store');
Route::get('/team', [\App\Http\Controllers\WebsiteController::class, 'team'])->name('team');
Route::get('/faq', [\App\Http\Controllers\WebsiteController::class, 'faq'])->name('faq');
Route::get('/testimonials', [\App\Http\Controllers\WebsiteController::class, 'testimonials'])->name('testimonials');
Route::get('/gallery', [\App\Http\Controllers\WebsiteController::class, 'gallery'])->name('gallery');
    Route::get('/partner-with-us', [\App\Http\Controllers\WebsiteController::class, 'partner'])->name('partner');
Route::get('/careers', [\App\Http\Controllers\WebsiteController::class, 'career'])->name('career');
Route::get('/privacy-policy', [\App\Http\Controllers\WebsiteController::class, 'privacy'])->name('privacy');
Route::get('/terms-and-conditions', [\App\Http\Controllers\WebsiteController::class, 'terms'])->name('terms');
Route::get('/page/{slug}', [\App\Http\Controllers\WebsiteController::class, 'page'])->name('page.show');
Route::get('/events', [\App\Http\Controllers\WebsiteController::class, 'events'])->name('events.index');
Route::get('/events/{slug}', [\App\Http\Controllers\WebsiteController::class, 'eventShow'])->name('events.show');
Route::post('/events/{slug}/reply', [\App\Http\Controllers\WebsiteController::class, 'storeEventReply'])->name('events.reply');

Route::post('/donation/checkout', [\App\Http\Controllers\DonationController::class, 'checkout'])->name('donation.checkout');
Route::post('/donation/process', [\App\Http\Controllers\DonationController::class, 'process'])->name('donation.process');
Route::get('/donation/thank-you', [\App\Http\Controllers\DonationController::class, 'thankYou'])->name('donation.thank-you');
Route::get('/donation/failed', [\App\Http\Controllers\DonationController::class, 'failed'])->name('donation.failed');

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, \App\Models\Language::where('is_active', true)->pluck('code')->toArray())) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');


