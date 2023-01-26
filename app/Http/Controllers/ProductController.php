<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //2º forma, con eloquent
        Product::create($request->all());
        return redirect()->route("products.index")->with("exito", "Producto añadido correctamente"); //El mensaje no saldrá de base, hay que recogerlo

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
        $product->nombre = $request->input("nombre"); //atributo "nombre" del input del formulario
        $product->descripcion = $request->input("descripcion");
        $product->precio = $request->input("precio");
        $product->save(); //Metodo de eloquent

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
        $product->delete();
        return redirect()->route("products.index")->with("exito", "Producto eliminado correctamente"); //El mensaje no saldrá de base, hay que recogerlo

    }
}
