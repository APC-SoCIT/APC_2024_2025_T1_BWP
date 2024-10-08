<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MembersOnlyController;
// to fix the issue redirecting to the localhost URL
use Illuminate\Support\Facades\URL;

$url = config('app.url');
URL::forceRootUrl($url);
Route::get('/catalogue/books', [DashboardController::class, 'catalogueBooks'])->name('catalogue.books');
Route::get('/catalogue/research', [DashboardController::class, 'catalogueResearch'])->name('catalogue.research');
Route::get('/catalogue/videos', [DashboardController::class, 'catalogueVideos'])->name('catalogue.videos');
Route::get('/catalogue/articles', [DashboardController::class, 'catalogueArticles'])->name('catalogue.articles');
// Home routes
Route::get('/', function() {
    return auth()->check() ? redirect()->route('dashboard') : view('dashboard');
})->name('home');
Route::get('donate-form', [HomeController::class, 'index'])->name('donate.index');
Route::post('donate-store', [HomeController::class, 'store'])->name('store.index');

// Authentication routes
Route::get('/login', [AuthManager::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

// Registration routes
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration')->middleware('guest');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');

// Routes for non-authenticated and authenticated users (dashboard view)
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// Routes for members only
Route::middleware(['auth', 'member'])->group(function () {
    Route::get('/members-only', [MembersOnlyController::class, 'index'])->name('members-only');
});

// Routes for admin users only
Route::middleware(['auth', 'admin'])->group(function () {
    // Book routes
    Route::get('/book', [DashboardController::class, 'book'])->name('book');
    Route::get('/add-book', [DashboardController::class, 'addBook'])->name('add-book');
    Route::post('/add-book', [DashboardController::class, 'uploadBook'])->name('upload-book');
    Route::delete('/book/{id}', [DashboardController::class, 'deleteBook'])->name('delete-book');

    // Research routes
    Route::get('/research', [DashboardController::class, 'research'])->name('research');
    Route::get('/add-research', [DashboardController::class, 'addResearch'])->name('add-research');
    Route::post('/add-research', [DashboardController::class, 'uploadResearch'])->name('upload-research');
    Route::delete('/research/{id}', [DashboardController::class, 'deleteResearch'])->name('delete-research');

    // Video routes
    Route::get('/video', [DashboardController::class, 'video'])->name('video');
    Route::get('/add-video', [DashboardController::class, 'addVideo'])->name('add-video');
    Route::post('/add-video', [DashboardController::class, 'uploadVideo'])->name('upload-video');
    Route::delete('/video/{id}', [DashboardController::class, 'deleteVideo'])->name('delete-video');

    // Article routes
    Route::get('/article', [DashboardController::class, 'article'])->name('article');
    Route::get('/add-article', [DashboardController::class, 'addArticle'])->name('add-article');
    Route::post('/add-article', [DashboardController::class, 'uploadArticle'])->name('upload-article');
    Route::delete('/article/{id}', [DashboardController::class, 'deleteArticle'])->name('delete-article');
});