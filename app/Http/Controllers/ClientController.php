<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Order;

class ClientController extends Controller
{
    //Filtro añadido al controlador. Tendrá que estar el usuario registrado para que pueda acceder
    public function __construct()
    {
        $this->middleware("auth");
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
        $clientList = Client::all();
        return view("client.index", ["clientList" => $clientList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("client.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "dni"=> "required|max: 9|min: 9",
            "name"=>"required",
            "surname"=>"required",
            "phoneNumber" => "required|max: 12",
            "email" => "required"
        ],[
            "dni.required"=> "Debes rellenar el campo DNI",
            "dni.max"=> "El DNI debe contener 9 carácteres como máximo",
            "dni.min" => "El DNI debe contener 9 carácteres como mínimo",
            "name.required"=> "Debes rellenar el campo Nombre",
            "surname.required"=> "Debes rellenar el campo Apellidos",
            "phoneNumber.required"=> "Debes rellenar el campo Teléfono",
            "phoneNumber.max"=> "ElTeléfono debe contener 12 carácteres como máximo",
            "email.required"=> "Debes rellenar el campo email",
            
        ]);
        
        Client::create($request->all());
        return redirect()->route("products.index")->with("exito", "Cliente añadido correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        //Necesitamos mostrar los pedidos de cliente: buscamos en la tabla orders donde la id enviada es igual a la client_id y metemos en un array todos los datos
        $orders = Order::where('client_id', $id)->get();
        //Mandamos a la vista show de cliente ambas variables para que podamos acceder a sus datos. Esto es una variable flash, que se añade a la sesion y cuando se usa es borrada
        return view("client.show")->with("client", $client)->with("orders", $orders);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);        
        return view("client.edit",["client" => $client]);
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
        $request->validate([
            "dni"=> "required|max: 9|min: 9",
            "name"=>"required",
            "surname"=>"required",
            "phoneNumber" => "required|max: 12",
            "email" => "required"
        ],[
            "dni.required"=> "Debes rellenar el campo DNI",
            "dni.max"=> "El DNI debe contener 9 carácteres como máximo",
            "dni.min" => "El DNI debe contener 9 carácteres como mínimo",
            "name.required"=> "Debes rellenar el campo Nombre",
            "surname.required"=> "Debes rellenar el campo Apellidos",
            "phoneNumber.required"=> "Debes rellenar el campo Teléfono",
            "phoneNumber.max"=> "ElTeléfono debe contener 12 carácteres como máximo",
            "email.required"=> "Debes rellenar el campo email",
            
        ]);

        $client = Client::Find($id);
        $client->dni = $request->input("dni");
        $client->name = $request->input("name");
        $client->surname = $request->input("surname");
        $client->phoneNumber = $request->input("phoneNumber");
        $client->email = $request->input("email");
        $client->save();

        return redirect()->route("clients.index")->with("exito", "Cliente actualizado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::Find($id);
        $client->delete();
        return redirect()->route("clients.index")->with("exito", "Cliente eliminado correctamente");
    }
}
