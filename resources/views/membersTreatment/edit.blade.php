@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="text-align:center;">
        <div class="col-md-12">
            <h1>Editar Cita</h1> 
            <br><br>           
        </div>
    </div>
    
        @if(isset($errores))                     
            <div class="alert alert-danger" style="width: 50%;">
                <h5>{{$errores}}</h5>                
            </div>
        @endif
    
        <div class="row justify-content-center">
        <div class="col-md-6">
        
            <h3>Cita actual</h3>
            Centro Actual: <span>{{ $centroActual -> nombre }}</span>
            <br><br>
            Tratamiento: <span>{{ $nombreTratamiento[0] -> nombre ?? '' }}</span>
            <br><br>
            Fecha: <span>{{ $membersTreatment->fecha ?? '' }}</span>
            
        </div>    

        <div class="col-md-6">
            <h3>Modificar Cita</h3>

            <form action="{{ route('membersTreatments.update', $membersTreatment->id) }}" method="POST"> 
                @csrf 
                @method("PUT")
                <br>
                <input type="hidden" name="member_id" id="member_id" value="{{ $membersTreatment->member_id}}">

                Centros:
                <select name="center_id">
                <optgroup label="Centros Estetica"></optgroup>
                @foreach($esteticas as $estetica )               
                <option value="{{ $estetica-> id}}" name="estetica_id" id="estetica_id">{{ $estetica-> nombre }}</option>                
                @endforeach
                <optgroup label="Peluquerías"></optgroup>
                @foreach($centros as $centro)               
                <option value="{{ $centro -> id}}" name="hairdresser_id" id="hairdresser_id">{{ $centro-> nombre }}</option>                
                @endforeach
                </select>
                <br><br>


                Tratamiento:
                <select name="treatment_id">
                @foreach($treatments as $treatment)                
                <option value="{{ $treatment-> id}}"  name="treatment_id" id="treatment_id">{{ $treatment->nombre }}</option>                
                @endforeach
                </select>
                <br><br>


                Dia: <input type="date" name="fecha" id="fecha" value="{{ $membersTreatment->fecha ?? '' }}">
                <br><br>  
                <button type="submit" style="width:100px; margin-right:10px;" class="btn btn-success">Actualizar</button>                            
                
            </form>
            <br>
        </div>
       
        <a class="btn btn-primary" style="width:100px;" href="{{ route('members.show', $membersTreatment->member_id)}}">Volver</a>
            
    </div>
</div>

@stop