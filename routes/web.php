<?php

use App\Http\Controllers\accountsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
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
Auth::routes(['verify' => true]);
Route::get('/get-started', function(){
    return view('auth.new');
})->name('welcome');
Route::get('/', function(){
    return view('pages.landing');
})->name('loggedin?');
Route::post('/login-custom',[accountsController::class,'logMeIn'])->name('login-custom');
Route::get('/dashboard/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/dashboard',function(){
    return redirect(route('dashboard'));
})->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard/{any}', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');
Route::get('/dashboard/advanced/{any}', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');
Route::get('/dashboard/advanced/account/{any}', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');
Route::get('/register-organisation', [App\Http\Controllers\newOrgcontroller::class, 'index'])->name('regOrg');
Route::get('/existing-organisation', [App\Http\Controllers\exOrgController::class, 'index'])->name('exOrga');
Route::post('/register-organisation/create', [App\Http\Controllers\newOrgcontroller::class, 'make'])->name('createOrg');
Route::post('/register-to-org', [App\Http\Controllers\exOrgController::class, 'register'])->name('register');
Route::get('/downloads/print-expenses-pdf', [App\Http\Controllers\pdfConverter::class, 'index']);