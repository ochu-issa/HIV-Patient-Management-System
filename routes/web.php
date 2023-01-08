<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OchuController;
use App\Http\Controllers\saveDataController;
use App\Http\Controllers\retrieveDataController;

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
Route::get('/doctor', [OchuController::class, 'Doctor'])->name('doctor');
Route::get('/receptionist', [OchuController::class, 'Receptionist'])->name('receptionist');
Route::get('/branchadmin', [OchuController::class, 'Branchadmin'])->name('branchadmin');

//branches
Route::get('/branches', [retrieveDataController::class, 'retrieveData'])->name('branches');
Route::get('/Addbranches', [saveDataController::class, 'saveData'])->name('Addbranches');
//delete branch
Route::delete('/branches/{id}', [saveDataController::class, 'deleteBranch'])->name('deleteBranch');
//update branch
Route::put('/branches/{id}', [saveDataController::class, 'updateRecord'])->name('updateBranch');
//update status branch
//Route::put('/branches/{id}', [saveDataController::class, 'updateStatus'])->name('updateStatus');
// Route::put('/branches/{id}', function() {
//     $controller1 = new saveDataController;
//     $controller1->updateRecord()->name('updateBranch');

//     $controller2 = new saveDataController;
//     $controller2->updateStatus();
// });

