<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OchuController;
use App\Http\Controllers\saveDataController;
use App\Http\Controllers\retrieveDataController;
use App\Http\Controllers\AuthController;
use GuzzleHttp\Psr7\Request;

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

Route::group(['middleware' => ['auth_check', 'prevent_back_history']], function(){
    Route::get('/login', [AuthController::class, 'Login'])->name('login');
    //login Route
    Route::post('/validate', [AuthController::class, 'authValidate'])->name('validate');

});

Route::group(['middleware' => ['auth', 'prevent_back_history']], function(){
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
    Route::post('/branchesStatus/{id}', [saveDataController::class, 'updateStatus'])->name('updateStatus');
    Route::post('/branchesStatusToOne/{id}', [saveDataController::class, '[updateStatusToOne]'])->name('updateStatusToOne');
    //logout
    Route::get('/auth/logout', [AuthController::class, 'Logout'])->name('auth.logout');
});





