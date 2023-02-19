@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <h1>Alta de Cita</h1>
            <br>

            <a class="btn btn-primary" href="{{route('members.index')}}">Lista Socios</a>

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

            <form action="{{ route('membersTreatments.store') }}" method="post">   
                @csrf                
                
                <input type="hidden" id="member_id" name="member_id" value="{{ $member -> id}}">
                Tratamiento:
                <select name="treatment_id">
                @foreach($treatments as $treatment)                
                <option value="{{ $treatment-> id}}" name="treatment_id" id="treatment_id">{{ $treatment->nombre }}</option>                
                @endforeach
                </select>                                
                <br><br>  
                Fecha: <input type="date" name="fecha" id="fecha">
                <br><br>                

                <button type="submit" class="btn btn-primary">Crear Cita Nueva</button>
            </form>
            <br>

            <div>
        <div>
    <div>

@stop