<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MemberController;
use App\Http\Controllers\MembersTreatmentController;

//Prueba para cargar login de ui laravel en bootstrap
Route::get('/', function () { 
    return view('welcome');   
});

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





Route::resource("members", MemberController::class);

Route::get("/membersTreatments/citaNueva/{id}", [MembersTreatmentController::class, "citaNueva"])->name("citaNueva");
Route::resource("membersTreatments", MembersTreatmentController::class);




//Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

