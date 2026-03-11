<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $user = request()->user();
    if ($user) {
        if ($user->role === \App\Enums\UserRole::Clerk) {
            return redirect()->route('clerk.dashboard');
        } elseif ($user->role === \App\Enums\UserRole::Officer) {
            return redirect()->route('officer.dashboard');
        } elseif ($user->role === \App\Enums\UserRole::AssistantDirector) {
            return redirect()->route('verification.dashboard');
        } elseif ($user->role === \App\Enums\UserRole::Director) {
            return redirect()->route('approval.dashboard');
        } elseif ($user->role === \App\Enums\UserRole::Admin) {
            return redirect()->route('admin.users.index');
        }
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // SVRMS Application Routes
    // ... all app routes
    Route::resource('applications', App\Http\Controllers\ApplicationController::class)->only(['show']);
    Route::resource('site-visits', App\Http\Controllers\SiteVisitController::class)->only(['show']);
    Route::resource('reviews', App\Http\Controllers\ReviewController::class)->only(['show']);

    // Filing & PDF Routes
    Route::get('filings', [App\Http\Controllers\FilingController::class, 'index'])->name('filings.index');
    Route::get('filings/{application}', [App\Http\Controllers\FilingController::class, 'show'])->name('filings.show');
    Route::post('filings/{application}/mark', [App\Http\Controllers\FilingController::class, 'markAsFiled'])->name('filings.mark');
    Route::get('filings/{application}/pdf/preview', [App\Http\Controllers\FilingController::class, 'previewPdf'])->name('filings.pdf.preview');
    Route::get('filings/{application}/pdf/download', [App\Http\Controllers\FilingController::class, 'generatePdf'])->name('filings.pdf.download');
});

// Clerk Module Routes
Route::middleware(['auth', 'role:Clerk'])->prefix('clerk')->name('clerk.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Clerk\DashboardController::class, 'index'])->name('dashboard');
    
    // Developer Check and Creation
    Route::get('/developers/create', [\App\Http\Controllers\Clerk\DeveloperController::class, 'create'])->name('developers.create');
    Route::post('/developers', [\App\Http\Controllers\Clerk\DeveloperController::class, 'store'])->name('developers.store');
    
    // Application Forms
    // Step 1: Check Developer
    Route::get('/applications/create', [\App\Http\Controllers\Clerk\ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications/check-developer', [\App\Http\Controllers\Clerk\ApplicationController::class, 'checkDeveloper'])->name('applications.check-developer');
    
    // Step 2: Register Application Details for an Existing Developer
    Route::get('/applications/create-details/{developer}', [\App\Http\Controllers\Clerk\ApplicationController::class, 'createDetails'])->name('applications.create-details');
    Route::post('/applications/{developer}', [\App\Http\Controllers\Clerk\ApplicationController::class, 'store'])->name('applications.store');

    // Step 3: Edit and Update existing Application
    Route::get('/applications/{application}/edit', [\App\Http\Controllers\Clerk\ApplicationController::class, 'edit'])->name('applications.edit');
    Route::put('/applications/{application}', [\App\Http\Controllers\Clerk\ApplicationController::class, 'update'])->name('applications.update');
});

// Officer Module Routes
Route::middleware(['auth', 'role:Officer'])->prefix('officer')->name('officer.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Officer\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/applications/{application}/site-registration/create', [\App\Http\Controllers\Officer\SiteRegistrationController::class, 'create'])->name('site-registration.create');
    Route::post('/applications/{application}/site-registration', [\App\Http\Controllers\Officer\SiteRegistrationController::class, 'store'])->name('site-registration.store');
    Route::get('/applications/{application}/site-visit/create', [\App\Http\Controllers\Officer\SiteVisitController::class, 'create'])->name('site-visit.create');
    Route::post('/applications/{application}/site-visit', [\App\Http\Controllers\Officer\SiteVisitController::class, 'store'])->name('site-visit.store');
    Route::get('/applications/{application}/review/create', [\App\Http\Controllers\Officer\ReviewController::class, 'create'])->name('review.create');
    Route::post('/applications/{application}/review', [\App\Http\Controllers\Officer\ReviewController::class, 'store'])->name('review.store');
});

// Assistant Director (Verification) Routes
Route::middleware(['auth', 'role:Assistant Director'])->prefix('management/verification')->name('verification.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Management\VerificationController::class, 'index'])->name('dashboard');
    Route::get('/applications/{application}', [\App\Http\Controllers\Management\VerificationController::class, 'show'])->name('show');
    Route::post('/applications/{application}', [\App\Http\Controllers\Management\VerificationController::class, 'update'])->name('update');
});

// Director (Approval) Routes
Route::middleware(['auth', 'role:Director'])->prefix('management/approval')->name('approval.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Management\ApprovalController::class, 'index'])->name('dashboard');
    Route::get('/applications/{application}', [\App\Http\Controllers\Management\ApprovalController::class, 'show'])->name('show');
    Route::post('/applications/{application}', [\App\Http\Controllers\Management\ApprovalController::class, 'update'])->name('update');
});

// Admin (User Management) Routes
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show']);
});

require __DIR__.'/auth.php';
