<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('password/reset', [\App\Http\Controllers\Admin\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [\App\Http\Controllers\Admin\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [\App\Http\Controllers\Admin\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [\App\Http\Controllers\Admin\ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/password', [AuthController::class, 'editPassword'])->name('password.edit');
    Route::post('/password', [AuthController::class, 'updatePassword'])->name('password.update');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('languages', \App\Http\Controllers\Admin\LanguageController::class);
    Route::get('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
    Route::resource('countries', \App\Http\Controllers\Admin\CountryController::class);
    Route::delete('media/bulk-delete', [\App\Http\Controllers\Admin\MediaController::class, 'bulkDestroy'])->name('media.bulk-delete');
    Route::resource('media', \App\Http\Controllers\Admin\MediaController::class)->only(['index', 'store', 'destroy']);
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
    Route::resource('menus', \App\Http\Controllers\Admin\MenuController::class);
    Route::get('menus/{menu}/builder', [\App\Http\Controllers\Admin\MenuController::class, 'builder'])->name('menus.builder');
    Route::post('menus/{menu}/items', [\App\Http\Controllers\Admin\MenuController::class, 'storeItem'])->name('menus.items.store');
    Route::delete('menus/{menu}/items/{item}', [\App\Http\Controllers\Admin\MenuController::class, 'destroyItem'])->name('menus.items.destroy');
    Route::resource('blog/categories', \App\Http\Controllers\Admin\CategoryController::class, ['as' => 'blog']);
    Route::resource('blog/posts', \App\Http\Controllers\Admin\BlogController::class, ['as' => 'blog']);

    // Homepage Content Routes
    Route::resource('sliders', \App\Http\Controllers\Admin\SliderController::class);
    Route::get('features/{id}/edit', [\App\Http\Controllers\Admin\FeatureController::class, 'edit'])->name('features.edit');
    Route::resource('features', \App\Http\Controllers\Admin\FeatureController::class);
    // Explicit route for Team edit to avoid implicit binding issues
    Route::get('team/{id}/edit', [\App\Http\Controllers\Admin\TeamMemberController::class, 'edit'])->name('team.edit');
    Route::resource('team', \App\Http\Controllers\Admin\TeamMemberController::class);
    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);
    Route::resource('partners', \App\Http\Controllers\Admin\PartnerController::class);
    Route::resource('gallery', \App\Http\Controllers\Admin\GalleryController::class);
    
    // Volunteer Section Routes
    Route::get('volunteer-section', [\App\Http\Controllers\Admin\VolunteerSectionController::class, 'index'])->name('volunteer.index');
    Route::post('volunteer-section/settings', [\App\Http\Controllers\Admin\VolunteerSectionController::class, 'updateSettings'])->name('volunteer.settings.update');
    Route::post('volunteer-section/counter', [\App\Http\Controllers\Admin\VolunteerSectionController::class, 'storeCounter'])->name('volunteer.counter.store');
    Route::put('volunteer-section/counter/{id}', [\App\Http\Controllers\Admin\VolunteerSectionController::class, 'updateCounter'])->name('volunteer.counter.update');
    Route::delete('volunteer-section/counter/{id}', [\App\Http\Controllers\Admin\VolunteerSectionController::class, 'destroyCounter'])->name('volunteer.counter.destroy');

    // About Section Routes
    Route::get('about-section', [\App\Http\Controllers\Admin\AboutSectionController::class, 'index'])->name('about.section.index');
    Route::post('about-section/settings', [\App\Http\Controllers\Admin\AboutSectionController::class, 'updateSettings'])->name('about.settings.update');
    Route::post('about-section/feature', [\App\Http\Controllers\Admin\AboutSectionController::class, 'storeFeature'])->name('about.feature.store');
    Route::put('about-section/feature/{id}', [\App\Http\Controllers\Admin\AboutSectionController::class, 'updateFeature'])->name('about.feature.update');
    Route::delete('about-section/feature/{id}', [\App\Http\Controllers\Admin\AboutSectionController::class, 'destroyFeature'])->name('about.feature.destroy');

    // About Page (Full Page) Routes
    Route::get('about-page', [\App\Http\Controllers\Admin\AboutPageController::class, 'index'])->name('about.page.index');
    Route::post('about-page/settings', [\App\Http\Controllers\Admin\AboutPageController::class, 'updateSettings'])->name('about.page.settings.update');
    Route::post('about-page/feature', [\App\Http\Controllers\Admin\AboutPageController::class, 'storeFeature'])->name('about.page.feature.store');
    Route::put('about-page/feature/{id}', [\App\Http\Controllers\Admin\AboutPageController::class, 'updateFeature'])->name('about.page.feature.update');
    Route::delete('about-page/feature/{id}', [\App\Http\Controllers\Admin\AboutPageController::class, 'destroyFeature'])->name('about.page.feature.destroy');

    Route::resource('campaigns', \App\Http\Controllers\Admin\CampaignController::class);
    Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
    Route::resource('donations', \App\Http\Controllers\Admin\DonationController::class)->only(['index', 'show']);
    Route::resource('volunteers', \App\Http\Controllers\Admin\VolunteerController::class)->except(['create', 'store', 'edit']);
    Route::resource('contact-submissions', \App\Http\Controllers\Admin\ContactSubmissionController::class)->except(['create', 'store', 'edit']);
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class);
    Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class);
    Route::resource('faq-categories', \App\Http\Controllers\Admin\FaqCategoryController::class);
});
