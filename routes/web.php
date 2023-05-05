<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RideController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //User Route
    Route::resource('users',\App\Http\Controllers\UserController::class);
    Route::resource('rides',\App\Http\Controllers\RideController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/rides/{ride_id}/add-passenger/{user_id}', [RideController::class,'addPassenger'])->name('rides.addPassenger');
    Route::get('/messages', 'ChatsController@index');
    Route::get('/messages/{id}', 'ChatsController@show');
    Route::post('/messages/{id}', 'ChatsController@sendMessage');


});
// Route::put('/rides/{ride}', [RideController::class, 'update']);
Route::get('/notifications', [NotificationController::class,'showNotifications'])->name('notifications.showNotifications');
// Route::post('/get-user-locations', 'LocationController@getUserLocations');

//Route::post('/location', [LocationController::class, 'store'])->name('current_user_location.store');
Route::get('/check-location', [LocationController::class,'check']);
Route::post('/store-location', [LocationController::class,'store']);
require __DIR__.'/auth.php';
