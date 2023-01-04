<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OchuController;
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

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', [OchuController::class, 'Test'])->name('home');
Route::get('/pattientarea', [OchuController::class, 'PattientArea'])->name('pattientarea');
Route::get('/pattient', [OchuController::class, 'Pattient'])->name('pattient');
Route::get('/branches', [OchuController::class, 'Branch'])->name('branches');
