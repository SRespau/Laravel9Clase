<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{

    /* Funcion por si queremos añadir en cada función la verificación, para no tener que copiar y pegar el mismo codigo todo el rato
    public function check404($study)
    {
        if (!$study) {
            response()->json(['status' => 404,'message' => 'No se ha encontrado un estudio con ese id'], 404)->send();
        die();
    }
}
    */

    //Le metemos un middleware para que tenga que estar autenticado para continuar
    public function __construct()
    {
        $this->middleware("auth:api");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Se debería devolver un objeto con una propiedad como mínimo data y el array de resultados en esa propiedad.
    // A su vez también es necesario devolver el código HTTP de la respuesta.
    public function index()
    {
        //Autorización de acceso. Asi sería en web:
        //$this->authorize("viewAny", Product::class);

        //En API. Comprobará ProductPolicy
        $user = \Auth::user();
        if ($user->can("viewAny", Product::class)) {

            // return Product::all(); Version incompleta. Version completa es devolver producto en json con un status
            $products = Product::all();

            return response()->json(['status' => 'ok', 'data' => $products], 200);
        }else{
            return response()->json(['status' => 'NOK', "message" => "No tiene permiso de acceso"], 403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        //En la api el validate no valdría ya que manda datos, no va a redireccionar de nuevo al formulario si fallase
        $request->validate([
            "nombre"=>"required|max: 100",
            "precio"=>"required|numeric|gt:0",
            "descripcion"=>"required"
        ]);*/

        //Para ello utilizamos Validator para validar los datos. Es un facade
        $validated = Validator::make($request->all(), [
            "nombre" => "required|max: 100",
            "precio" => "required|numeric|gt:0",
            "descripcion" => "required"
        ]);

        if ($validated->fails()) {
            return response()->json(["status" => "NOK", "errors" => $validated->errors()], 422); //422 “unprocessable entity.”
        }
        $newProduct = Product::create($request->all());
        return response()->json(["status" => "ok", "data" => $newProduct], 201); //Cuando se crea algo se devuelve 201 - Created
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Corresponde con la ruta /studies/{study}
        // Buscamos un study por el ID.
        $product = Product::find($id);

        // Chequeamos si encontró o no el product
        if (!$product) {
            // Se devuelve un array errors con los errores detectados y código 404
            return response()->json(['errors' => (['code' => 404, 'message' => 'No se encuentra un producto con ese código.'])], 404);
        }

        // Devolvemos la información encontrada.
        return response()->json(['status' => 'ok', 'data' => $product], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Que busque el producto y de un error si no lo encuentra
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['status' => 'NOK', 'message' => 'No se encuentra un producto con ese código.'], 404);
        }

        //Validamos y creamos
        $validated = Validator::make($request->all(), [
            "nombre" => "required|max: 100",
            "precio" => "required|numeric|gt:0",
            "descripcion" => "required"
        ]);

        if ($validated->fails()) {
            return response()->json(["status" => "NOK", "errors" => $validated->errors()], 422); //422 “unprocessable entity.”
        }

        //Obtenemos todos datos y los guardamos
        $product->fill($request->all());
        $product->save();

        return response()->json(['status' => 'ok', 'data' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['status' => 'NOK', 'message' => 'No se encuentra un producto con ese código.'], 404);
        }

        try {
            $product->delete();
            return response()->json(["mensaje" => "Borrado Correctamente"], 204);
        } catch (\Throwable $th) {
            return response()->json(["status" => "NOK", "mensaje" => "Borrado fallido", "error" => $th->getMessage()], 409);
        }
    }
}
