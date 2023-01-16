<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OchuController;
use App\Http\Controllers\saveDataController;
use App\Http\Controllers\retrieveDataController;
use App\Http\Controllers\AuthController;
use GuzzleHttp\Psr7\Request;


Route::group(['middleware' => ['auth_check', 'prevent_back_history']], function(){
    Route::get('/login', [AuthController::class, 'Login'])->name('login');
    //login Route
    Route::post('/validate', [AuthController::class, 'authValidate'])->name('validate');

});

Route::group(['middleware' => ['auth', 'prevent_back_history']], function(){
    Route::get('/', [OchuController::class, 'Test'])->name('home');
    Route::get('/pattientarea', [OchuController::class, 'PattientArea'])->name('pattientarea');
    Route::get('/pattient', [OchuController::class, 'Pattient'])->name('pattient');

    //branches routes
    Route::get('/branches', [retrieveDataController::class, 'retrieveData'])->name('branches');
    Route::get('/Addbranches', [saveDataController::class, 'saveData'])->name('Addbranches');
    //delete branch
    Route::delete('/branches/{id}', [saveDataController::class, 'deleteBranch'])->name('deleteBranch');
    //update branch
    Route::post('/branch/update', [saveDataController::class, 'updateRecord'])->name('updateBranch');
    Route::post('/branchesStatus/{id}', [saveDataController::class, 'updateStatus'])->name('updateStatus');
    Route::post('/branchesStatusToOne/{id}', [saveDataController::class, 'updateStatusToOne'])->name('updateStatusToOne');
    //retrieve data ajax
    Route::get('/testing-response/{id}', [OchuController::class, 'responseCheck'])->name('testing-response');
    //end of branch route

    //Branch Admin routes
    Route::get('/branchadmin', [retrieveDataController::class, 'ShowBranchAdminData'])->name('branchadmin');
    Route::get('/Addbranchadmin', [saveDataController::class, 'AddBranchAdmin'])->name('addbranchadmin');
    //End Branch Admin routes

    //Receptionist routes
    Route::get('/receptionist', [retrieveDataController::class, 'ShowReceptionistData'])->name('receptionist');
    Route::get('/Addreceptionist', [saveDataController::class, 'AddReceptionist'])->name('Addreceptionist');

    //Doctors routes
    Route::get('/doctor', [retrieveDataController::class, 'ShowDoctorsData'])->name('doctor');
    Route::get('/AddDoctor', [saveDataController::class, 'AddDoctor'])->name('AddDoctor');


    //role and permission routes
    Route::get('/setting', [retrieveDataController::class, 'RolePermission'])->name('setting');

    //logout
    Route::get('/auth/logout', [AuthController::class, 'Logout'])->name('auth.logout');
    Route::get('/testing', [OchuController::class, 'testing'])->name('testing');


});







