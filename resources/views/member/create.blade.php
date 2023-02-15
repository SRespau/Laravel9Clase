@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <h1>Alta de Socio</h1>
            <br>

            <a class="btn btn-primary" href="{{route('socios.index')}}">Lista Socios</a>

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

            <form action="{{ route('socios.store') }}" method="post">   
                @csrf 
                
                <br>
                Nombre: <input type="text" name="nombre" id="nombre">
                <br><br>
                Apellidos: <input type="text" name="apellidos" id="apellidos">
                <br><br>
                Dirección: <input type="text" name="direccion" id="direccion">
                <br><br>
                Teléfono: <input type="text" name="telefono" id="telefono">
                <br><br>
                Email: <input type="text" name="email" id="email">
                <br><br>                
                <button type="submit" class="btn btn-primary">Crear producto</button>
            </form>
            <br>

            <div>
        <div>
    <div>

@stop