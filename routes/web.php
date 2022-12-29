<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::group(['prefix'=>'admin','middleware'=>['admin:admin']],function(){
//     Route::get('/login',[AdminController::class, 'loginForm']);
//     Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
// });
Route::middleware('admin:admin')->group(function(){
    Route::get('admin/login',[AdminController::class, 'loginForm']);
    Route::post('admin/login',[AdminController::class, 'store'])->name('admin.login');
});



// Admin Dashboard
Route::middleware(['auth:admin',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// User Dashboard
Route::middleware(['auth:web',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
