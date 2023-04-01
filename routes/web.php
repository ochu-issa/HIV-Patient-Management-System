<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OchuController;
use App\Http\Controllers\saveDataController;
use App\Http\Controllers\retrieveDataController;
use App\Http\Controllers\AuthController;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


Route::group(['middleware' => ['auth_check', 'prevent_back_history']], function(){
    Route::get('/login', [AuthController::class, 'Login'])->name('login');
    //login Route
    Route::post('/validate', [AuthController::class, 'authValidate'])->name('validate');

});

Route::group(['middleware' => ['auth', 'prevent_back_history']], function(){
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

    //Branch Admin routes
    //$this->middleware(['role_or_permission:Create-Branch-Admin, View-Branch-Admin, Edit-Branch-Admin, Delete-Branch-Admin']);
    // /**  @var \App\Models\MyUserModel $user **/
    //$user = User::find(auth()->user());
    // if(!$user->hasAnyPermission(['Create-Branch-Admin, View-Branch-Admin, Edit-Branch-Admin, Delete-Branch-Admin']))
    // {
    // abort(404);
    // }
    // else
    // {
    Route::get('/branchadmin', [retrieveDataController::class, 'ShowBranchAdminData'])->name('branchadmin');
    Route::get('/Addbranchadmin', [saveDataController::class, 'AddBranchAdmin'])->name('addbranchadmin');
    //End Branch Admin routes
   // }

    //Receptionist routes
    Route::get('/receptionist', [retrieveDataController::class, 'ShowReceptionistData'])->name('receptionist');
    Route::get('/Addreceptionist', [saveDataController::class, 'AddReceptionist'])->name('Addreceptionist');

    //Doctors routes
    Route::get('/doctor', [retrieveDataController::class, 'ShowDoctorsData'])->name('doctor');
    Route::get('/AddDoctor', [saveDataController::class, 'AddDoctor'])->name('AddDoctor');

    //Pattient Route
    Route::get('/pattient', [retrieveDataController::class, 'ShowPattientData'])->name('pattient');
    Route::get('/Addpattient', [saveDataController::class, 'AddPattient'])->name('addpattient');
    Route::get('/pattientdetails', [retrieveDataController::class, 'PattientDetails'])->name('pattientdetails');
    Route::get('/pattientarea', [retrieveDataController::class, 'PattientArea'])->name('pattientarea');

    //Patient details Route
    Route::get('/SearchPatient', [saveDataController::class, 'SearchPatient'])->name('searchpatient');
    Route::get('/AddPatientRecord', [saveDataController::class, 'AddMedicalRecord'])->name('addpatientrecord');
    Route::get('/PatientInformation', [saveDataController::class, 'Patient_information'])->name('patientinformation');
    Route::post('/DeleteMedicalRecord', [saveDataController::class, 'DeleteMedicalRecord'])->name('deletemedicalrecord');
    Route::post('/SendMessage', [saveDataController::class, 'SendMessage'])->name('sendmessage');
    Route::post('/DeleteMessage', [saveDataController::class, 'DeleteMessage'])->name('deletemessage');



    //role and permission routes
    Route::get('/setting', [retrieveDataController::class, 'RolePermission'])->name('setting');

    //logout
    Route::get('/auth/logout', [AuthController::class, 'Logout'])->name('auth.logout');
    Route::get('/testing', [OchuController::class, 'testing'])->name('testing');


    Route::get('/AddPersmission', [saveDataController::class, 'AddPermission'])->name('AddPermission');

});







