<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainUserController;
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
        return view('admin.index');
    })->name('dashboard');
});
// All Admin Routes
Route::get('/admin/logout',[AdminController::class, 'destroy'])->name('admin.logout');
Route::get('/admin/profile',[AdminController::class, 'adminProfile'])->name('admin.profile');
Route::get('/admin/profile/edit',[AdminController::class, 'adminProfileEdit'])->name('admin.profile.edit');
Route::post('/admin/profile/store',[AdminController::class, 'adminProfileStore'])->name('admin.profile.store');
Route::get('/admin/password/view',[AdminController::class, 'adminPasswordView'])->name('admin.password.view');
Route::post('/admin/password/update',[AdminController::class, 'adminPasswordUpdate'])->name('admin.password.update');


// User Dashboard
Route::middleware(['auth:web',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.index');
    })->name('dashboard');
});

// All User Routes
Route::get('/user/logout',[MainUserController::class, 'logout'])->name('user.logout');
Route::get('/user/profile',[MainUserController::class, 'userProfile'])->name('user.profile');
Route::get('/user/profile/edit',[MainUserController::class, 'userProfileEdit'])->name('user.profile.edit');
Route::post('/user/profile/store',[MainUserController::class, 'userProfileStore'])->name('user.profile.store');
Route::get('/user/password/view',[MainUserController::class, 'userPasswordView'])->name('user.password.view');
Route::post('/user/password/update',[MainUserController::class, 'userPasswordUpdate'])->name('user.password.update');

