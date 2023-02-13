<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudyController; //Añadimos el studycontroller para enrutar los metodos de la clase
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\AppEjemplo;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\VideoclubController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;

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
//Ejecuta de la lista la primera que encuentre correcta, luego se sale. Si tuvieramos 2 "/hola" con cosas diferentes cogería la primera y nunca entraría a la segunda

/*
Route::get("/hola", function (){
    echo "Hola mundo";
});

Route::get("/hola/{nombre}", function ($nombre){ //Los parametros se añade en la ruta entre llaves {}. Lo que haya dentro llegará como parametro a la función que ponga
    echo "Hola $nombre";
});

Route::get("/saludo/{nombre?}", function ($nombre = "Mundo"){// El interrogante es para decirle que si no se inserta ningún parametro en la ruta que ponga mundo. Si pone parametro que salga el parametro
    echo "Hola $nombre";
});
*/

/*
// RUTAS CON NOMBRE
Route::get("/contacta-con-ies", function(){
    return "dinos tu duda";
})->name("contacto"); //Es como un alias. Nombramos esa ruta como contacto. Así si cambiamos la dirección no hace falta cambiarla en todos sitios. Abajo cogerá el alias y no la dirección

Route::get("/informacion-asignatura", [AppEjemplo::class, "mostrarInformacion"])->name("infoasig"); //Ponemos alias y en la ruta llamamos al metodo mostrarInformación del controlador AppEjemplo

Route::get('/', function () { //La página index (local) habremos puesto 3 enlaces que lleva a la ruta del Route de arriba. Enlazamos una ruta con otra
    //return view('welcome');
    //echo "<a href='contacta-con-ies'>Contacto 1</a><br>"; Ruta absoluta entera para acceder
    echo "<a href='" . route('contacto') . "'>Contacto 2</a><br>"; //Para poner el alias nuevo "contacto" que le hemos añadido al route de arriba
    echo "<a href='" . route('infoasig') . "'>Mostrar información asignatura</a><br>";
});
*/


/*
//CONTROLADOR EJEMPLO StudiesController

//Rutas del ejercicio Study
//Route::get("/studies", [StudyController::class, "index"]); //Enrutamos el metodo index de la clase StudyController. Cuando pongamos /studies en el navegador devolveremos index
//Route::get("/studies/create", [StudyController::class, "create"]); //El orden importa. Si lo pongo debajo de show cogera "create" como parametro. Al ponerlo encima reservamos la palabra create solo para este método
//Route::get("/studies/{id}", [StudyController::class, "show"]);

//Ejercicio: poner que el id de show sea un número
Route::get("/studies/{id}", [StudyController::class, "show"]) -> where ("id", "[\d]+"); //Con este vamos al método show
// o también
Route::get("/studies/{id}", function ($id){ //Con este hacemos directamente una función al llamar la ruta
    echo "El modulo con id: $id";
}) -> where ("id", "[\d]+");

//Route::get("/studies/{id}/edit", [StudyController::class, "edit"]);
//Route::delete("/studies/{id}/destroy", [StudyController::class, "destroy"]);
//Route::put("/studies/{id}/update", [StudyController::class, "update"]);
//Route::post("/studies/store", [StudyController::class, "store"]);

//Route::resource("/studies",StudyController::class); //Con esto hacemos todas las rutas anteriores en una sola linea. Leerá los metodos que tenemos en la clase como rutas
*/


/*
//CONTROLADOR PruebaController
Route::get("prueba2/{name}", [PruebaController::class, "saludoCompleto"]); 


//PRUEBAS PLANTILLAS
Route::get("pruebaPlantillas", [AppEjemplo::class, "pruebasPlantillas"]);


//CONTROLADOR AsignaturaController
Route::resource("/asignaturas", AsignaturaController::class);


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
Route::resource("products", ProductController::class); //Equivale a los 7 metodos


//CONTROLADOR ClientController
Route::resource("clients", ClientController::class);

//CONTROLADOR StudyController
Route::resource("studies", StudyController::class);



//Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

