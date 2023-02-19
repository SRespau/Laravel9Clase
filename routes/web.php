<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PruebaController;
use App\Http\Controllers\AppEjemplo;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\VideoclubController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
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






//CONTROLADOR VideoclubController
//Route::get("/", [VideoclubController::class, "index"]);
Route::get("/login", [VideoclubController::class, "login"]);
Route::get("/logout", [VideoclubController::class, "logout"]);
Route::get("/catalog", [VideoclubController::class, "index"]);
Route::get("/catalog/show/{id}", [VideoclubController::class, "show"]);
Route::get("/catalog/create", [VideoclubController::class, "create"]);
Route::get("/catalog/edit/{id}", [VideoclubController::class, "edit"]);

*/
//CONTROLADOR ProductController
Route::resource("products", ProductController::class);


//CONTROLADOR ClientController
Route::resource("clients", ClientController::class);

//CONTROLADOR StudyController
Route::resource("members", MemberController::class);

Route::get("/membersTreatments/citaNueva/{id}", [MembersTreatmentController::class, "citaNueva"])->name("citaNueva");
Route::resource("membersTreatments", MembersTreatmentController::class);




//Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

