<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembersTreatment;
use App\Models\Treatment;
use App\Models\Member;
use App\Models\AestheticCenter;
use App\Models\Hairdresser;
use Carbon\Carbon;


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
        
        $centros = Hairdresser::all();
        $esteticas = AestheticCenter::all();

        return view("membersTreatment.create")->with("treatments", $treatments)->with("member", $member)->with("esteticas", $esteticas)->with("centros", $centros);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $memberId = $request->input("member_id");
        
        $historialCitas = MembersTreatment::where("member_id", $memberId)->get();
        
        $member = Member::find($memberId);
        $treatments = Treatment::all();
        $centros = Hairdresser::all();
        $esteticas = AestheticCenter::all();

        $fechaHoy = Carbon::now()->format('Y-m-d');

        for($i = 0; $i < sizeof($historialCitas); $i++){
            if($historialCitas[$i]["fecha"] === $request->input("fecha") || $request->input("fecha") < $fechaHoy){
                return view("membersTreatment.create")->with("treatments", $treatments)->with("member", $member)->with("errores", "Fecha añadida no válida. Fecha ya añadida al socio o fecha ya pasada.")->with("esteticas", $esteticas)->with("centros", $centros);
            }
        }

        $cita = new MembersTreatment();
        $cita->member_id = $request->input("member_id");
        $cita->fecha = $request->input("fecha");        
        $cita->treatment_id = $request->input("treatment_id"); 
        
        if(substr($request->input("center_id"), 0, 1) == "B") {
            $cita->aesthetic_id =  $request->input("center_id");
            $cita->hairdresser_id = null;
        }else{
            $cita->aesthetic_id =  null;
            $cita->hairdresser_id = $request->input("center_id");
        }
        $cita->save();
        
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
        $centros = Hairdresser::all();
        $esteticas = AestheticCenter::all();
        
        $nombreTratamiento = Treatment::where("id", $membersTreatment["treatment_id"])->get();
        
        $treatments = Treatment::all();

        if($membersTreatment["aesthetic_id"] == null){
            $centroActual = Hairdresser::find($membersTreatment["hairdresser_id"]);
        }else{
            $centroActual = AestheticCenter::find($membersTreatment["aesthetic_id"]);
        }
        
        //$this->authorize("update", $member);
        
        return view("membersTreatment.edit")->with("membersTreatment", $membersTreatment)->with("treatments", $treatments)->with("nombreTratamiento", $nombreTratamiento)->with("esteticas", $esteticas)->with("centros", $centros)->with("centroActual", $centroActual);
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
        $cita = MembersTreatment::Find($id);
        $historialCitas = MembersTreatment::where("member_id", $request->input("member_id"))->get();
        
        //$this->authorize("update", $member);       
        $centros = Hairdresser::all();
        $esteticas = AestheticCenter::all();
        $treatments = Treatment::all();

        $nombreTratamiento = Treatment::where("id", $cita["treatment_id"])->get();

        $cita->member_id = $request->input("member_id");        

        $fechaHoy = Carbon::now()->format('Y-m-d');
        
        if($cita["aesthetic_id"] == null){
            $centroActual = Hairdresser::find($cita["hairdresser_id"]);
        }else{
            $centroActual = AestheticCenter::find($cita["aesthetic_id"]);
        }
        
        for($i = 0; $i < sizeof($historialCitas); $i++){
            if($historialCitas[$i]["fecha"] === $request->input("fecha") ||  $request->input("fecha") < $fechaHoy){
                return view("membersTreatment.edit")->with("membersTreatment", $cita)->with("treatments", $treatments)->with("nombreTratamiento", $nombreTratamiento)->with("esteticas", $esteticas)->with("centros", $centros)->with("centroActual", $centroActual)->with("errores", "Fecha añadida no válida. Fecha ya añadida al socio o fecha ya pasada.");
            }
        }

        $cita->fecha = $request->input("fecha");        
        $cita->treatment_id = $request->input("treatment_id"); 
        
        if(substr($request->input("center_id"), 0, 1) == "B") {
            $cita->aesthetic_id =  $request->input("center_id");
            $cita->hairdresser_id = null;
        }else{
            $cita->aesthetic_id =  null;
            $cita->hairdresser_id = $request->input("center_id");
        }
        $cita->save();


        return redirect()->route("members.index")->with("exito", "Cita actualizado correctamente"); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cita = MembersTreatment::Find($id);
        
        $this->authorize("delete", $cita);
        
        $cita->delete();
        return redirect()->route("members.index")->with("exito", "Cita eliminada correctamente");
    }
}
