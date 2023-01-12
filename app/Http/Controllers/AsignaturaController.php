<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo "Esto es el index de asignatura controller";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Muestra el formulario de alta de una asignatura
        return view("asignaturas.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Recoge los datos del formulario de alta. 
        // Aqui iria la logica de insertar en la bbdd. save(modelo)
        /*
        $nombre = $request->input("nombre"); //Asi obtenemos el valor del input con nombre "nombre" del formulario que se recibe en request
        $ciclo = $request->input("ciclo");
        $curso = $request->input("curso");
        $comentario = $request->input("comentarios");

        dd($nombre, $ciclo, $curso, $comentario);
        */
        
        /*Validamos los datos introducidos en el formulario, asegurandonos que cada campo es rellenado*/ 
        //Si hay algun campo vacio cargará la misma página de formulario de nuevo. Esto dará unos errores que trataremos en el formulario (create.blade.php)
        //La diferencia con poner required en la etiqueta es que una se valida en cliente y otra en el servidor cuando se envian los datos. Lo interesante sería añadirlo en ambos sitios
        $datos = $request->validate([ 
            "nombre"=>"required|max:7", //Esto es una cadena de opciones, se pueden insertar las que sean necesarias
            "curso"=>"required|integer|size:1|regex:/[1-2]/",
            "ciclo"=>["required","size:3","regex:/DA[M|W]/"] // | no es admitida en laravel en regex. Hay que usar array de opciones y además poner un size porque no coge limite de caracteres [a-z] sería un caracter, pero laravel admite varios         
        ],[ //Si creamos una segunda array podemos personalizar los errores que muestra
            "nombre.required" => "Debes rellenar el campo " . "'" . "nombre" . "'",
            "nombre.max" => "El campo nombre debe tener menos de 7 caracteres",
            "curso.required" => "Debes rellenar el campo " . "'" . "curso" . "'",       
            "curso.integer" => "El campo curso debe ser un número entero",
            "curso.regex" => "El campo curso debe ser 1 o 2",
            "ciclo.required" => "Debes rellenar el campo " . "'" . "ciclo" . "'",
            "ciclo.regex" => "El campo ciclo debe ser DAM o DAW"
        ]);
        dd($datos);

        /*Recoger todos los datos enviados del formulario 
        $datos = $request->all();
        dd($datos);
        */

        /*Recoger solamente el nombre y el ciclo del request
        $datos = $request->only("nombre", "ciclo");
        dd($datos);
        */

        /*Recoger todo menos el nombre
        $datos = $request->except("nombre");
        dd($datos);
        */

        //Verificar que existe un campo en el formulario
        /*
        $nuevocampo = ""; //Realmente si queremos mostrarlo lo cogeriamos con un input
        if($request->has("nombre")){ //Si el campo esta vacío aparece como null. Lo detectará igualmente y devolvera valor null
            dd($request->input("nombre"));
        }else{
            dd("El campo no existe");
        }
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
