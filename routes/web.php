<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth'])->group(function(){
    Route::get('/', [App\Http\Controllers\RestaurantController::class, 'index']); 
    Route::resource('menu', App\Http\Controllers\MenuController::class);
    Route::resource('restaurant', App\Http\Controllers\RestaurantController::class);
    Route::get('restaurant/{id}/details', [App\Http\Controllers\RestaurantController::class, 'details'])->name('restaurant.details');
    Route::get('menu/{id}/info', [App\Http\Controllers\MenuController::class, 'info'])->name('menu.info');

});

Auth::routes(['register' => false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('lang/{locale}', function ($locale) {
    print(app()->getLocale($locale) . '<br>'); // dabartinė
    if (!in_array($locale, ['en', 'es', 'lt'])) abort(400);
    session(['locale' => $locale]);
    app()->setLocale($locale);
    return redirect()->back();
    print(app()->getLocale($locale) . '<br>'); // dabartinė
})->name('locale.setting');

