<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MembersOnlyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForumController;
use Illuminate\Support\Facades\URL;

// Fix the issue redirecting to the localhost URL
$url = config('app.url');
URL::forceRootUrl($url);

// Catalogue Routes
Route::get('/catalogue/books', [DashboardController::class, 'catalogueBooks'])->name('catalogue.books');
Route::get('/catalogue/research', [DashboardController::class, 'catalogueResearch'])->name('catalogue.research');
Route::get('/catalogue/videos', [DashboardController::class, 'catalogueVideos'])->name('catalogue.videos');
Route::get('/catalogue/articles', [DashboardController::class, 'catalogueArticles'])->name('catalogue.articles');

// Home Routes
Route::get('/', function() {
    return redirect()->route('dashboard');
})->name('home');

Route::get('donate-form', [HomeController::class, 'index'])->name('donate.index');
Route::post('donate-store', [HomeController::class, 'store'])->name('store.index');

// Authentication Routes
Route::get('/login', [AuthManager::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration')->middleware('guest');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// Member Only Routes
Route::middleware(['auth', 'member'])->group(function () {
    Route::get('/members-only', [MembersOnlyController::class, 'index'])->name('members-only');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Book Routes
    Route::get('/book', [DashboardController::class, 'book'])->name('book');
    Route::get('/add-book', [DashboardController::class, 'addBook'])->name('add-book');
    Route::post('/add-book', [DashboardController::class, 'uploadBook'])->name('upload-book');
    Route::delete('/book/{id}', [DashboardController::class, 'deleteBook'])->name('delete-book');

    // Research Routes
    Route::get('/research', [DashboardController::class, 'research'])->name('research');
    Route::get('/add-research', [DashboardController::class, 'addResearch'])->name('add-research');
    Route::post('/add-research', [DashboardController::class, 'uploadResearch'])->name('upload-research');
    Route::delete('/research/{id}', [DashboardController::class, 'deleteResearch'])->name('delete-research');

    // Video Routes
    Route::get('/video', [DashboardController::class, 'video'])->name('video');
    Route::get('/add-video', [DashboardController::class, 'addVideo'])->name('add-video');
    Route::post('/add-video', [DashboardController::class, 'uploadVideo'])->name('upload-video');
    Route::delete('/video/{id}', [DashboardController::class, 'deleteVideo'])->name('delete-video');

    // Article Routes
    Route::get('/article', [DashboardController::class, 'article'])->name('article');
    Route::get('/add-article', [DashboardController::class, 'addArticle'])->name('add-article');
    Route::post('/add-article', [DashboardController::class, 'uploadArticle'])->name('upload-article');
    Route::delete('/article/{id}', [DashboardController::class, 'deleteArticle'])->name('delete-article');
});

// User Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/profile/edit', [UserController::class, 'edit'])->name('user.profile.edit');
    Route::put('/user/profile', [UserController::class, 'update'])->name('user.profile.update');
});

// Forum Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{id}/reply', [ForumController::class, 'reply'])->name('forum.reply');
});

