<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    
    public function __construct()    {
        
        $this->middleware("auth");
        session(["contador" => 0]); //Creamos un valor "contador" en la sesion cuando inicialice el producto
        //$this->middleware("auth")->only("index"); Filtrar solo Index
        //$this->middleware("auth")->except("index"); Filtrar todo menos index

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("viewAny", Product::class); //Regla en app/Policies para restringir acceso. Le añadimos el objeto de la clase de la politica para que se dirija ahí
        $productList = Product::all(); //Eloquent ORM
        //return $productList; //Comprobación de que funciona. Envia en JSON los datos de products
        return view("product.index", ["productList"=>$productList]); //Primer productList es lo que enviaremos al index. Segundo productList es la variable donde cogera los datos. Estamos enlazando ambos nombres
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("create", Product::class);
        return view("product.create"); //"product" SI es vista singular, si es metodo en plural
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([//validar los datos insertados en el input
            "nombre"=>"required|max: 100",
            "precio"=>"required|numeric|gt:0",
            "descripcion"=>"required"
        ],[
            "nombre.required" => "Debes rellenar el campo " . "'" . "nombre" . "'",
            "nombre.max" => "El campo nombre debe tener menos de 100 caracteres",
            "precio.required" => "Debes rellenar el campo " . "'" . "precio" . "'",
            "precio.numeric" => "El campo " . "'" . "precio" . "'" . " debe ser numerico.",
            "precio.gt" => "El campo " . "'" . "precio" . "'" . " debe ser mayor que 0.",
            "descripcion.required" => "Debes rellenar el campo " . "'" . "descripcion" . "'",

        ]);
        /*
        //Primera forma de hacerlo
        $product = new Product();
        $product->nombre = $request->input("nombre"); //atributo "name" del input del formulario
        $product->descripcion = $request->input("descripcion");
        $product->precio = $request->input("precio");
        $product->save(); //Metodo de eloquent
        */
        $this->authorize("create", Product::class);

        //2º forma, con eloquent       
        Product::create($request->all());
        return redirect()->route("products.index")->with("exito", "Producto añadido correctamente"); //El mensaje no saldrá de base, hay que recogerlo
        //-with() es una variable flash. Es una variable que se añade en la sesion y luego desaparece despues de ser usada 1 vez.
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        //buscar producto
        $product = Product::find($id);//Laravel con las migraciones, modelo y demás buscará solo en el SQL que le hemos establecido
        
        $this->authorize("view", $product); //Ponemos el producto que hay que enseñar a ver si tiene privilegios 
        
        //Ejercicio sesiones. Sumar +1 al contador de la sesion cuando la id es par y reiniciar cuando sea impar
        if($product->id % 2 == 0){
            //Version literal
            // $contador = session("contador");
            // $contador += 1;
            // session(["contador" => $contador]);

            //Version laravel. Incrementa un valor entero
            session()->increment("contador");
            session(["color" => "Rojo"]);
        }else{
            session(["contador" => 0]);
            session(["color" => "Verde"]);
        }
        
        //Devolver vista
        return view("product.show", ["product" => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        //buscar producto
        $product = Product::find($id);
        $this->authorize("update", $product);
        //Devolver vista
        return view("product.edit", ["product" => $product]);
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
        
        $request->validate([//validar los datos insertados en el input
            "nombre"=>"required|max: 100",
            "precio"=>"required|numeric|gt:0",
            "descripcion"=>"required"
        ],[
            "nombre.required" => "Debes rellenar el campo " . "'" . "nombre" . "'",
            "nombre.max" => "El campo nombre debe tener menos de 100 caracteres",
            "precio.required" => "Debes rellenar el campo " . "'" . "precio" . "'",
            "precio.numeric" => "El campo " . "'" . "precio" . "'" . " debe ser numerico.",
            "precio.gt" => "El campo " . "'" . "precio" . "'" . " debe ser mayor que 0.",
            "descripcion.required" => "Debes rellenar el campo " . "'" . "descripcion" . "'",

        ]);
        $product = Product::Find($id);
        $this->authorize("update", $product); //Politica para permitir acceso
        $product->nombre = $request->input("nombre"); //atributo "nombre" del input del formulario
        $product->descripcion = $request->input("descripcion");
        $product->precio = $request->input("precio");
        $product->save(); //Metodo de eloquent

        /*
        $product->fill($request->all());
        $product->save();
        */
        return redirect()->route("products.index")->with("exito", "Producto actualizado correctamente"); //El mensaje no saldrá de base, hay que recogerlo
        //return redirect()->action([ProductController::class, "index"]); //Redirijo a Index y muestra un mensaje
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::Find($id);
        $this->authorize("delete", $product);
        $product->delete();
        return redirect()->route("products.index")->with("exito", "Producto eliminado correctamente"); //El mensaje no saldrá de base, hay que recogerlo

    }
}
