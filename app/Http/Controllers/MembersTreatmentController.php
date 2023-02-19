<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembersTreatment;
use App\Models\Treatment;
use App\Models\Member;

class MembersTreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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


    public function citaNueva($id){

        $member = Member::find($id);
        $treatments = Treatment::all();       
        
        return view("membersTreatment.create")->with("treatments", $treatments)->with("member", $member);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        MembersTreatment::create($request->all());
        
        return redirect()->route("members.index")->with("exito", "Cita añadida correctamente");
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
        $membersTreatment = MembersTreatment::find($id);
        
        $nombreTratamiento = Treatment::where("id", $membersTreatment["treatment_id"])->get();
        
        $treatments = Treatment::all();
        //$this->authorize("update", $member);
        
        return view("membersTreatment.edit")->with("membersTreatment", $membersTreatment)->with("treatments", $treatments)->with("nombreTratamiento", $nombreTratamiento);
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
        $membersTreatment = MembersTreatment::Find($id);
        //$this->authorize("update", $member);       
        
        $membersTreatment->treatment_id = $request->input("treatment_id");
        $fechaCompleta = $request->input("fecha") . " " . $request->input("hora");
        $membersTreatment->fecha = $fechaCompleta;

        $membersTreatment->save();

        // $membersTreatment->fill($request->all());
        // $membersTreatment->save();

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
        //
    }
}
