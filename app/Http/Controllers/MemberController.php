<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{

    public function __construct(){        
               
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->authorize("viewAny", Member::class);
        $memberList = Member::all();
        return view("member.index", ["memberList"=>$memberList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize("create", Member::class);
        return view("member.create"); 
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
            "nombre"=>"required|max: 40",
            "apellidos"=>"required|max: 80",
            "direccion"=>"required",
            "telefono" =>"required",
            "email",
        ],[
            "nombre.required" => "Debes rellenar el campo " . "'" . "nombre" . "'",
            "nombre.max" => "El campo nombre debe tener menos de 40 caracteres",
            "apellidos.required" => "Debes rellenar el campo " . "'" . "apellidos" . "'",
            "apellidos.max" => "El campo apellidos debe tener menos de 80 caracteres",
            "direccion.required" => "Debes rellenar el campo " . "'" . "direccion" . "'",
            "telefono.required" => "Debes rellenar el campo " . "'" . "telefono" . "'",
        ]);

        //$this->authorize("create", Member::class);
        Member::create($request->all());
        return redirect()->route("members.index")->with("exito", "Socio añadido correctamente");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);
        //$this->authorize("view", $member);
        return view("member.show", ["member" => $member]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::find($id);
        //$this->authorize("update", $member);
        return view("member.edit", ["member" => $member]);
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
            "nombre"=>"required|max: 40",
            "apellidos"=>"required|max: 80",
            "direccion"=>"required",
            "telefono" =>"required",
            "email",
        ],[
            "nombre.required" => "Debes rellenar el campo " . "'" . "nombre" . "'",
            "nombre.max" => "El campo nombre debe tener menos de 40 caracteres",
            "apellidos.required" => "Debes rellenar el campo " . "'" . "apellidos" . "'",
            "apellidos.max" => "El campo apellidos debe tener menos de 80 caracteres",
            "direccion.required" => "Debes rellenar el campo " . "'" . "direccion" . "'",
            "telefono.required" => "Debes rellenar el campo " . "'" . "telefono" . "'",
        ]);
        $member = Member::Find($id);
        $this->authorize("update", $member);
        $member->fill($request->all());
        $member->save();
        return redirect()->route("members.index")->with("exito", "Socio actualizado correctamente"); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::Find($id);
       // $this->authorize("delete", $member);
        $member->delete();
        return redirect()->route("members.index")->with("exito", "Socio eliminado correctamente");

    }
}
