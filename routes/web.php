<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('admin.dashboard');

Route::get('/users', function () {
return view('admin.users');
})->middleware(['auth'])->name('admin.users');

Route::get('/role', function () {
    return view('admin.role');
})->middleware(['auth'])->name('admin.role');

Route::get('/data-pegawai', function () {
    return view('admin.data-pegawai');
})->middleware(['auth'])->name('admin.data-pegawai');


Route::get('/jabatan', function () {
    return view('admin.jabatan');
})->middleware(['auth'])->name('admin.jabatan');

Route::get('/users', 'App\Http\Controllers\User\UserController@userall');

require __DIR__.'/auth.php';
