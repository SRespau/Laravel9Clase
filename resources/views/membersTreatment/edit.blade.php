@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <h1>Editar Cita</h1>
            <br>

            <a class="btn btn-primary" href="{{route('members.index')}}">Lista Socios</a>
            <br><br>
            @if($errors->any())
            
            <div class="alert alert-danger" style="width: 30%;">
                <h5>Por favor, corrige los siguientes errores:</h5>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <h3>Cita actual</h3>
            Tratamiento: <span>{{ $nombreTratamiento[0] -> nombre ?? '' }}</span>
            <br><br>
            Fecha: <span>{{ $membersTreatment->fecha ?? '' }}</span>
            
            <br><br>  <br><br>     


            <h3>Modificar Cita</h3>

            <form action="{{ route('membersTreatments.update', $membersTreatment->id) }}" method="POST"> 
                @csrf 
                @method("PUT")
                <br>
                <input type="hidden" name="member_id" id="member_id" value="{{ $membersTreatment->member_id}}">

                Tratamiento:
                <select name="treatment_id">
                @foreach($treatments as $treatment)                
                <option value="{{ $treatment-> id}}"  name="treatment_id" id="treatment_id">{{ $treatment->nombre }}</option>                
                @endforeach
                </select>
                <br><br>


                Dia: <input type="date" name="fecha" id="fecha" value="{{ $membersTreatment->fecha ?? '' }}">
                <br><br>
                Hora: <input type="string" name="hora" id="hora">
                <br><br>                
                
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
            <br>

            <div>
        <div>
    <div>

@stop