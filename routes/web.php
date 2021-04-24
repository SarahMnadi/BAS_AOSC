<?php

use App\Models\Organization;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');






// Route::get('/user/addUser', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('addUser')->middleware('auth');
// Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'view'])->name('profile')->middleware('auth');

// Route::get('/user/changepassword', [App\Http\Controllers\UserController::class, 'changePassword'])->name('changepassword')->middleware('auth');
// Route::get('/organization/index', [App\Http\Controllers\OrganizationController::class, 'index'])->name('organization')->middleware('auth');

// Route::get('/organizations/queryAll', [App\Http\Controllers\OrganizationController::class, 'getLastFiveOrganizations'])->name('queryAllOrganizations');











// Route::get('/device/index', [App\Http\Controllers\DeviceController::class, 'index'])->name('device')->middleware('auth');




// Routes for organization controller
Route::get('organization/showOne/{id}', [App\Http\Controllers\OrganizationController::class, 'showOne'])->name('showOneOrganization');
Route::get('organization/showAll', [App\Http\Controllers\OrganizationController::class, 'showAll'])->name('showAllOrganizations');
Route::get('organization/showLatestTen', [App\Http\Controllers\OrganizationController::class, 'showLatestTen'])->name('showLatestTenOrganizations');
Route::post('organization/store', [App\Http\Controllers\OrganizationController::class, 'store'])->name('storeOrganization');
Route::get('organization/returnName/{id}', [App\Http\Controllers\OrganizationController::class, 'returnName'])->name('returnOrganizationName');
Route::post('organization/update/{id}', [App\Http\Controllers\OrganizationController::class, 'update'])->name('updateOrganization');

// Routes for Branch controller
Route::get('branch/showOne/{id}', [App\Http\Controllers\BranchController::class, 'showOne'])->name('showOneBranch');
Route::post('branch/store/{organizationId}', [App\Http\Controllers\BranchController::class, 'store'])->name('storeBranch');
Route::get('branch/showAll', [App\Http\Controllers\BranchController::class, 'showAll'])->name('showAllBranches');
Route::post('branch/update/{id}', [App\Http\Controllers\BranchController::class, 'update'])->name('updateBranch');

// Routes for Department controller
Route::post('department/store/{branchId}', [App\Http\Controllers\DepartmentController::class, 'store'])->name('storeDepartment');
Route::get('/department/showOne/{id}', [App\Http\Controllers\DepartmentController::class, 'showOne'])->name('showOneDepartment');
Route::get('/department/showAll', [App\Http\Controllers\DepartmentController::class, 'showAll'])->name('showAllDepartments');
Route::post('department/update/{id}', [App\Http\Controllers\DepartmentController::class, 'update'])->name('updateDepartment');

// Routes for Device controller
Route::post('device/store/{organizationId}', [App\Http\Controllers\DeviceController::class, 'store'])->name('storeDevice');
Route::get('/device/showOne/{id}', [App\Http\Controllers\DeviceController::class, 'showOne'])->name('showOneDevice');
Route::get('/device/showAll', [App\Http\Controllers\DeviceController::class, 'showAll'])->name('showAllDevices');

// Routes for User controller
Route::get('/user/allUsers', [App\Http\Controllers\UserController::class, 'viewAll'])->name('allUsers');
Route::get('showAllUsers', [App\Http\Controllers\RoughController::class, 'show_all_users'])->name('showAllUsers');