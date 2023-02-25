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
    //Constructor para la aplicación del middleware de autenticación
    public function __construct(){        
        $this->middleware("auth");      
    }

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
     * Metodo para crear una cita nueva para el socio ya creado
     * 
     * @return \Illuminate\Http\Response 
     * Devuelve como respuesta la vista create con información de tratamientos, miembros, centros de peluqueria y estetica
     */
    public function citaNueva($id){

        $member = Member::find($id);
        $treatments = Treatment::all();       
        
        $centros = Hairdresser::all();
        $esteticas = AestheticCenter::all();

        $this->authorize("update", $member);

        return view("membersTreatment.create")->with("treatments", $treatments)->with("member", $member)->with("esteticas", $esteticas)->with("centros", $centros);
    }

    /**
     * Store a newly created resource in storage.
     * Obtiene el miembro al que se le añadirá la cita.
     * Obtiene el historial de citas del miembro
     * Obtiene como información adicional todos los tratamientos y centros de imagen personal
     * Comprueba si la fecha de la cita es menor al día de hoy o igual a alguna que ya tiene dada en su historial
     *  Si devuelve true, devolverá la vista create con los mismos datos de información que traia y un error advirtiendo fecha incorrecta
     * Si todo es correcto, guardará la cita añadida enlazada al usuario
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * Devuelve al finalizar la vista show con los datos del usuario y un mensaje de éxito
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

        if($request->input("fecha") < $fechaHoy){
            return view("membersTreatment.create")->with("treatments", $treatments)->with("member", $member)->with("errores", "Fecha añadida no válida. Fecha ya añadida al socio o fecha ya pasada.")->with("esteticas", $esteticas)->with("centros", $centros);
        }
        
        for($i = 0; $i < sizeof($historialCitas); $i++){
            if($historialCitas[$i]["fecha"] === $request->input("fecha")){
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
        
        return redirect()->route('members.show', $member->id)->with("exito", "Cita añadida correctamente");
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
     *  Obtendrá la información de la cita, los centros de imagen personal, el tratamiento individual que tiene asignado y todos los tratamientos
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * Devuelve la tabla edit con la totalidad de la información para mostrarla en pantalla
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
        
        $this->authorize("update", $membersTreatment);
        
        return view("membersTreatment.edit")->with("membersTreatment", $membersTreatment)->with("treatments", $treatments)->with("nombreTratamiento", $nombreTratamiento)->with("esteticas", $esteticas)->with("centros", $centros)->with("centroActual", $centroActual);
    }

    /**
     * Update the specified resource in storage.
     * Obtendrá la información de la cita en concreto, del historial de citas del usuario, de los centros de imagen personal, nombre del tratamiento y todos los tratamientos
     * Comparará si la fecha actualizada de la cita es menor al día de hoy o igual a alguna ya dada en su historial de citas
     *      Si cumple alguna concición de estas, devolverá la vista edit con toda la información que tenía anteriormente mostrada en pantalla, además de un mensaje de error de fecha inválida
     * Comprobará en que centro se ha añadido la cita, obteniendo la primera leetra de su id
     *      Dependiendo la letra del centro, añadirá la id en la columna del centro correcto y la otra añadirá null
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * Devolverá la vista index con un mensaje de éxito
     */
    public function update(Request $request, $id)
    {
        $cita = MembersTreatment::Find($id);
        $historialCitas = MembersTreatment::where("member_id", $request->input("member_id"))->get();
        
              
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
        
        if($request->input("fecha") < $fechaHoy){
            return view("membersTreatment.edit")->with("membersTreatment", $cita)->with("treatments", $treatments)->with("nombreTratamiento", $nombreTratamiento)->with("esteticas", $esteticas)->with("centros", $centros)->with("centroActual", $centroActual)->with("errores", "Fecha añadida no válida. Fecha ya añadida al socio o fecha ya pasada.");

        }
        
        for($i = 0; $i < sizeof($historialCitas); $i++){
            if($historialCitas[$i]["fecha"] === $request->input("fecha")){
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
     * Busca la cita mediante la id
     * Borra la cita
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * Devuelve la vista show enviando la id del socio y un mensaje de éxito
     */
    public function destroy($id)
    {
        $membersTreatment = MembersTreatment::Find($id);
        $memberId = ($membersTreatment["member_id"]);
        $this->authorize("delete", $membersTreatment);
        
        $membersTreatment->delete();
        return redirect()->route("members.show", $memberId)->with("exito", "Cita eliminada correctamente");
    }
}
