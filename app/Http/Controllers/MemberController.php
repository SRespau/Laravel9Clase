<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MembersTreatment;
use App\Models\Treatment;
use App\Models\AestheticCenter;
use App\Models\Hairdresser;
use Carbon\Carbon;

class MemberController extends Controller
{
    //Constructor para la aplicación del middleware de autenticación
    public function __construct(){        
        $this->middleware("auth");      
    }


    /**
     * Display a listing of the resource.
     * Muestra toda la información de los socios ordenada por nombre ascedentemente y paginada con 10 registros por página
     * @return \Illuminate\Http\Response
     * Devuelve la vista index con toda la información de los socios
     */
    public function index()
    {
        $this->authorize("viewAny", Member::class);
        $memberList = Member::orderBy('nombre')->paginate(10);;
        return view("member.index", ["memberList"=>$memberList]);
    }

    /**
     * Show the form for creating a new resource.
     *  Obtiene la información de todos los tratamientos y centros de imagen personal
     * @return \Illuminate\Http\Response
     * Devuelve la vista create con la información obtenida
     */
    public function create()
    {
        $this->authorize("create", Member::class);
        $treatments = Treatment::all();

        $centros = Hairdresser::all();
        $esteticas = AestheticCenter::all();

        return view("member.create")->with("treatments", $treatments)->with("centros", $centros)->with("esteticas", $esteticas);
    }

    /**
     * Store a newly created resource in storage.
     * Valida los datos obtenidos en el request a través del formulario y devuelve un error si algún dato no es correcto
     * Obtenemos los datos de tratamientos y centros de imagen personal
     * Comparará si la fecha insertada es menor que la fecha actual o si el campo lo han dejado vacio
     *      Si se cumple la condición, devolverá la vista create con un error de fecha inválida.
     * Comparará si los campos de cita están vacíos
     *      Si se cumple la condición, creará el socio sin crear la cita
     *      Si no se cumple la condición, creará el socio y le añadirá la cita, creando un campo en la tabla correspondiente con la id del centro elegido
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * Devuelve la vista index con un mensaje de éxito
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
        $fechaHoy = Carbon::now()->format('Y-m-d');
        $treatments = Treatment::all();
        $centros = Hairdresser::all();
        $esteticas = AestheticCenter::all();
        
        
        if($request->input("fecha") < $fechaHoy && $request->input("fecha") != null){
            return view("member.create")->with("errores", "Fecha añadida no válida. ")->with("treatments", $treatments)->with("centros", $centros)->with("esteticas", $esteticas);
        }

        $member = new Member();
        $member->nombre = $request->input("nombre");
        $member->apellidos = $request->input("apellidos");
        $member->direccion = $request->input("direccion");
        $member->telefono = $request->input("telefono");
        $member->email= $request->input("email");
        $member->save();
        
        $lastMember = Member::latest("id")->first();
        

        if($request->input("center_id") != "--" && $request->input("treatment_id") != "--"){
            if($request->input("fecha") == null){
                return view("member.create")->with("errores", "Fecha añadida no válida. ")->with("treatments", $treatments)->with("centros", $centros)->with("esteticas", $esteticas);
            }
            
            $cita = new MembersTreatment();
            $cita->fecha = $request->input("fecha");
            $cita->member_id = $lastMember["id"];
            $cita->treatment_id = $request->input("treatment_id"); 
            
            if(substr($request->input("center_id"), 0, 1) == "B") {
                $cita->aesthetic_id =  $request->input("center_id");
                $cita->hairdresser_id = null;
            }else{
                $cita->aesthetic_id =  null;
                $cita->hairdresser_id = $request->input("center_id");
            }
            
            $cita->save();
        }

        return redirect()->route("members.index")->with("exito", "Socio añadido correctamente");

    }

    /**
     * Display the specified resource.
     * Obtiene el miembro mediante la id enviada
     * Obtiene todas las citas enlazadas a su id
     * Obtiene los tratamientos que hay enlazados a su cita
     *      Para usuarios "gerentes": Calcula el total gastado del cliente sumando su historico con los precios de la tabla tratamientos
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * Devuelve la vista show con los datos obtenidos para mostrarlos por pantalla
     */
    public function show($id)
    {
        $member = Member::find($id);
        $this->authorize("view", $member);
        $dates = MembersTreatment::where("member_id", $id)->get();
        
        
        $treatments = [];
        for($i = 0; $i < sizeof($dates); $i++){
            array_push($treatments, Treatment::where("id", $dates[$i]["treatment_id"])->get());
        }

        $total = 0;
        for($i = 0; $i < sizeof($treatments); $i++){
            $total += $treatments[$i][0]["precio"];
        }

        return view("member.show")->with("member", $member)->with("dates", $dates)->with("treatments", $treatments)->with("total", $total);
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
        $this->authorize("update", $member);
        return view("member.edit", ["member" => $member]);
    }

    /**
     * Update the specified resource in storage.
     * Valida los datos obtenidos en el request a través del formulario y devuelve un error si algún dato no es correcto
     * Obtiene los datos del request y los guarda en la base de datos
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * Devuelve la vista index con un mensaje de éxito
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
     * Obtiene el miembro mediante su id
     * Borra el miembro
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * Devuelve la vista index con un mensaje de éxito.
     */
    public function destroy($id)
    {
        $member = Member::Find($id);
        
        $this->authorize("delete", $member);
        
        $member->delete();
        return redirect()->route("members.index")->with("exito", "Socio eliminado correctamente");
    }
}
