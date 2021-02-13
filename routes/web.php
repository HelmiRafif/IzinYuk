<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TunjanganController;
use App\Http\Controllers\PotonganController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\IzinController;

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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [Controller::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles',RoleController::class);
    Route::resource('permissions',PermissionController::class);
    Route::resource('users',UserController::class);    
    Route::resource('jabatan',JabatanController::class);
    Route::resource('tunjangan',TunjanganController::class);
    Route::resource('potongan',PotonganController::class);
    Route::resource('pegawai',PegawaiController::class);
    Route::resource('izin',IzinController::class);

    Route::get('/dashboard', function(){
        return view('admin.dashboard');

    });
});


// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth'])->name('admin.dashboard');


// Route::get('/users', 'App\Http\Controllers\User\UserController@userall')->name('users');

// Route::get('users/tambah-user', 'App\Http\Controllers\User\UserController@useradd')->name('user.add');

// Route::get('users/role-edit/{id}', 'App\Http\Controllers\User\UserController@edit')->name('edit');

// Route::patch('users/role-register-update/{id}', 'App\Http\Controllers\User\UserController@updateuser')->name('update');

// Route::delete('users/hapus-user/{id}', 'App\Http\Controllers\User\UserController@deleteuser')->name('delete');


// Route::get('/roles', function () {
//     return view('admin.role.role');
// })->middleware(['auth'])->name('admin.role.role');

// Route::get('roles/add-role', function() {
//     return view('admin.role.add-role');
// })->middleware(['auth'])->name('add-role');

// // Route::get('users/add-role', 'App\Http\Controllers\Role\role@addrole')->name('addrole');

// Route::get('/permission', 'App\Http\Controllers\Role\PermissionController@show');

// Route::get('permission/add-permission', function () {
//     return view('admin.permission.add-permission');
// })->middleware(['auth'])->name('add-permission');

// Route::post('permission/addedpermission', 'App\Http\Controllers\Role\PermissionController@create')->name('added');

// // Route::get('permission/add-permission', 'App\Http\Controllers\Role\permission@addpermission')->name('addpermission');


// Route::get('/data-pegawai', function () {
//     return view('admin.data-pegawai');
// })->middleware(['auth'])->name('admin.data-pegawai');


// Route::get('/jabatan', function () {
//     return view('admin.jabatan');
// })->middleware(['auth'])->name('admin.jabatan');

require __DIR__.'/auth.php';