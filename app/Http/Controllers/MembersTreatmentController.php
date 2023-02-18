<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembersTreatment;
use App\Models\Treatment;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MembersTreatment::create($request->all());
        //return redirect()->route("members.index")->with("exito", "Socio añadido correctamente");
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
        $treatments = Treatment::all();
        //$this->authorize("update", $member);
        
        return view("membersTreatment.edit")->with("membersTreatment", $membersTreatment)->with("treatments", $treatments);
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
        
        $membersTreatment->fill($request->all());
        $membersTreatment->save();

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
