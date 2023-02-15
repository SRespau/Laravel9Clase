<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StudyController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



//usar la función response() y el método json para cambiar el status
//el $data que enviamos podría ser cualqueir cosa: objeto, array,...
Route::get('/', function() {
    $data = ['message' => 'Bienvenido a la API (con status 200)'];
    //return $data  devuelve solamente los datos
    return response()->json($data, 200); //Enviamos una respuesta en json y mandamos la variable data y el status 200 (correcto)
});

//Esta define 7 rutas. No nos valdría
// Route::resource("/products", ProductController::class);

//En la api solo hay 5 rutas, por eso hay que hacer excepcion de 2 de ellas.
Route::resource('products', ProductController::class)->except(['create', 'edit']);

Route::resource('studies', StudyController::class)->except(['create', 'edit']);

//Ruta que se va a aplicar a todo ello que no se encuentre
//Siempre hay que ponerlo al final de todo. Es la ruta de ultimo recurso. Cuando compruebe todas y no encuentre la ruta abrira esta
Route::fallback(function () {
    return response()->json(['error' => 'No encontrado'], 404);
});



// rutas con este prefijo: /api/auth/....
//Las rutas las voy a restringir con un middleware
//Los metodos se ponen a mano porque el resource coge el CRUD.
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth' //Todas las rutas que estan dentro tienen que tener el prefijo auth -> http://laravel9.local/api/auth/login
    ], function ($router) {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh',  [AuthController::class, 'refresh']);
        Route::post('me',  [AuthController::class, 'me']);
});    





