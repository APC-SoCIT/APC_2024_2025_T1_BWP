<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\{
    dashboardController,
    HomeController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('donate-form', [HomeController::class, 'index'])->name('donate.index');
Route::post('donate-store', [HomeController::class, 'store'])->name('store.index');

// Route for log-in
Route::get('/login', [AuthManager::class, 'login'])->name('login')->middleware('admin');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

// Route for registration
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration')->middleware('notAdmin');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post')->middleware('notAdmin');

// Route for dashboard
Route::get('/dashboard', [dashboardController::class, 'dashboard'])->name('dashboard')->middleware('notAdmin');

// Route for book
Route::get('/book', [dashboardController::class, 'book'])->name('book')->middleware('notAdmin');
Route::get('/add-book', [dashboardController::class, 'addBook'])->name('add-book')->middleware('notAdmin');
Route::get('/update-book/{id}', [dashboardController::class, 'editBook'])->name('edit-book')->middleware('notAdmin');
Route::post('/add-book', [dashboardController::class, 'uploadBook'])->name('upload-book')->middleware('notAdmin');
Route::put('/update-book/{id}', [dashboardController::class, 'updateBook'])->name('update-book')->middleware('notAdmin');

// Route for research
Route::get('/research', [dashboardController::class, 'research'])->name('research')->middleware('notAdmin');
Route::get('/add-research', [dashboardController::class, 'addResearch'])->name('add-research')->middleware('notAdmin');
Route::get('/update-research/{id}', [dashboardController::class, 'editResearch'])->name('edit-research')->middleware('notAdmin');
Route::post('/add-research', [dashboardController::class, 'uploadResearch'])->name('upload-research')->middleware('notAdmin');
Route::put('/update-research/{id}', [dashboardController::class, 'updateResearch'])->name('update-research')->middleware('notAdmin');

// Route for video
Route::get('/video', [dashboardController::class, 'video'])->name('video')->middleware('notAdmin');
Route::get('/add-video', [dashboardController::class, 'addVideo'])->name('add-video')->middleware('notAdmin');
Route::get('/update-video/{id}', [dashboardController::class, 'editVideo'])->name('edit-video')->middleware('notAdmin');
Route::post('/add-video', [dashboardController::class, 'uploadVideo'])->name('upload-video')->middleware('notAdmin');
Route::put('/update-video/{id}', [dashboardController::class, 'updateVideo'])->name('update-video')->middleware('notAdmin');

// Route for article
Route::get('/article', [dashboardController::class, 'article'])->name('article')->middleware('notAdmin');
Route::get('/add-article', [dashboardController::class, 'addArticle'])->name('add-article')->middleware('notAdmin');
Route::get('/update-article/{id}', [dashboardController::class, 'editArticle'])->name('edit-article')->middleware('notAdmin');
Route::post('/add-article', [dashboardController::class, 'uploadArticle'])->name('upload-article')->middleware('notAdmin');
Route::put('/update-article/{id}', [dashboardController::class, 'updateArticle'])->name('update-article')->middleware('notAdmin');
