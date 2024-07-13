<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OchuController;
use App\Http\Controllers\saveDataController;
use App\Http\Controllers\retrieveDataController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OtpCodeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientSessionController;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


Route::group(['middleware' => ['auth_check', 'prevent_back_history']], function () {
    Route::get('/login', [AuthController::class, 'Login'])->name('login');
    //login Route
    Route::post('/validate', [AuthController::class, 'authValidate'])->name('validate');
});

Route::group(['middleware' => ['auth', 'prevent_back_history']], function () {
    Route::get('/', [OchuController::class, 'Test'])->name('home');


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


    Route::get('/branchadmin', [retrieveDataController::class, 'ShowBranchAdminData'])->name('branchadmin');
    Route::get('/Addbranchadmin', [saveDataController::class, 'AddBranchAdmin'])->name('addbranchadmin');
    //End Branch Admin routes


    //Receptionist routes
    Route::get('/receptionist', [retrieveDataController::class, 'ShowReceptionistData'])->name('receptionist');
    Route::get('/Addreceptionist', [saveDataController::class, 'AddReceptionist'])->name('Addreceptionist');

    //Doctors routes
    Route::get('/doctor', [retrieveDataController::class, 'ShowDoctorsData'])->name('doctor');
    Route::get('/AddDoctor', [saveDataController::class, 'AddDoctor'])->name('AddDoctor');

    //Pattient Route
    Route::get('/pattient', [retrieveDataController::class, 'ShowPattientData'])->name('pattient');
    Route::get('/pattientdetails', [retrieveDataController::class, 'PattientDetails'])->name('pattientdetails');
    Route::get('/pattientarea', [retrieveDataController::class, 'PattientArea'])->name('pattientarea');

    Route::post('/Addpattient', [PatientController::class, 'store'])->name('addpattient');
    Route::post('patient/update/password', [PatientController::class, 'update'])->name('patient.update.password');

    //Patient details Route
    Route::get('/SearchPatient', [saveDataController::class, 'SearchPatient'])->name('searchpatient');
    Route::post('/AddPatientRecord', [saveDataController::class, 'AddMedicalRecord'])->name('addpatientrecord');
    Route::get('/PatientInformation', [saveDataController::class, 'Patient_information'])->name('patientinformation');
    Route::post('/DeleteMedicalRecord', [saveDataController::class, 'DeleteMedicalRecord'])->name('deletemedicalrecord');
    Route::post('/SendMessage', [saveDataController::class, 'SendMessage'])->name('sendmessage');
    Route::post('/DeleteMessage', [saveDataController::class, 'DeleteMessage'])->name('deletemessage');
    Route::post('/generateReport', [saveDataController::class, 'generateReport'])->name('generatereport');



    //patient sessions routes
    Route::group(['prefix' => 'patient-sessions'], function () {
        Route::get('', [PatientSessionController::class, 'index'])->name('patient-sessions.index');
        Route::get('create', [PatientSessionController::class, 'create'])->name('patient-sessions.create');
        Route::post('store', [PatientSessionController::class, 'store']);
        Route::get('show/{id}/{session_id}', [PatientSessionController::class, 'show'])->name('patient-sessions.show');
        Route::post('close', [PatientSessionController::class, 'closeSession'])->name('patient-sessions.close');
    });


    //pattient OTP
    Route::group(['prefix' => 'otp-codes'], function () {
        Route::post('store', [OtpCodeController::class, 'store'])->name('otp-codes.store');
    });

    //settings
    Route::group(['prefix' => 'settings'], function () {
        Route::get('otp-codes', [OtpCodeController::class, 'index'])->name('settings.otp_codes');
        Route::get('role-permissions', [retrieveDataController::class, 'RolePermission'])->name('settings.rele_permissions');
    });


    //details profile
    Route::get('/profile', [retrieveDataController::class, 'profileDetails'])->name('profile');

    //logout
    Route::get('/auth/logout', [AuthController::class, 'Logout'])->name('auth.logout');
    Route::get('/testing', [OchuController::class, 'testing'])->name('testing');


    Route::get('/AddPersmission', [saveDataController::class, 'AddPermission'])->name('AddPermission');
});

//call event
// Route::get('/seed-event', [SaveDataController::class, 'seedEvent']);
Route::get('/optimize-event', [SaveDataController::class, 'optimizeEvent']);
Route::get('/cache-event', [SaveDataController::class, 'cacheEvent']);
Route::get('/config-event', [SaveDataController::class, 'configEvent']);
