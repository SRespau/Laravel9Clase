<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppEjemplo extends Controller{
    
    public function mostrarInformacion(){
        $nombreModulo = "Memelogía";
        $ciclo = "DAW";
        
        $departamentos["nombreDpto"] = "Gatera";
        $departamentos["ubicacion"] = "Planta Baja";


        // 4 Formas de pasarle el array asociativo al return view(vista, datos); datos será un array asociativo y será un parámetro opcional
        //Enviará los datos a la vista del return
        //return view("muestraAsignatura"); Forma básica sin enviarle nada más
        
        //1º forma
        //return view("muestraAsignatura", array("nombreModulo" => "Memelogía", "ciclo" => "DAW"));

        //2º forma
        //return view("muestraAsignatura",["nombreModulo" => "Memelogía", "ciclo" => "DAW"]);

        //3º forma. Con BLADE
        //return view("muestraAsignatura")->with(["nombreModulo" => "Memelogía", "ciclo" => "DAW"]);

        //4º forma (y mejor). Con compact le pasamos las variables y las convierte en un array asociativo. Los nombres de las variables se pasan como cadena
        return view("muestraAsignatura", compact("nombreModulo", "ciclo", "departamentos"));
        //Si se encuentra en una subcarpeta dentro de views. Se puede poner con . o con / pero mejor con .
        //return view("asignaturas.muestraAsignatura", compact("nombreModulo", "ciclo", "departamentos"));

        //5º forma y ya en desuso
        //$datos["nombreModulo"] = "Memelogia";
        //$datos["ciclo"] = "DAW";
        
        //return view("muestraAsignatura, $datos);

        

    }

    public function pruebasPlantillas()
    {
        return view("asignaturas.page");
    }
}
