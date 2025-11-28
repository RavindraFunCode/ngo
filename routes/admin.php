<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('languages', \App\Http\Controllers\Admin\LanguageController::class);
    Route::get('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
    Route::resource('media', \App\Http\Controllers\Admin\MediaController::class)->only(['index', 'store', 'destroy']);
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
    Route::resource('menus', \App\Http\Controllers\Admin\MenuController::class);
    Route::get('menus/{menu}/builder', [\App\Http\Controllers\Admin\MenuController::class, 'builder'])->name('menus.builder');
    Route::post('menus/{menu}/items', [\App\Http\Controllers\Admin\MenuController::class, 'storeItem'])->name('menus.items.store');
    Route::delete('menus/{menu}/items/{item}', [\App\Http\Controllers\Admin\MenuController::class, 'destroyItem'])->name('menus.items.destroy');
    Route::resource('blog/categories', \App\Http\Controllers\Admin\CategoryController::class, ['names' => 'admin.blog.categories']);
    Route::resource('blog', \App\Http\Controllers\Admin\BlogController::class);
    Route::resource('campaigns', \App\Http\Controllers\Admin\CampaignController::class);
    Route::resource('donations', \App\Http\Controllers\Admin\DonationController::class)->only(['index', 'show']);
    Route::resource('volunteers', \App\Http\Controllers\Admin\VolunteerController::class)->except(['create', 'store', 'edit']);
    Route::resource('contact-submissions', \App\Http\Controllers\Admin\ContactSubmissionController::class)->except(['create', 'store', 'edit']);
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class);
});
