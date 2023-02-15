@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <h1>Editar Producto</h1>
            <br>

            <a class="btn btn-primary" href="{{route('members.index')}}">Lista Productos</a>

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

            <form action="{{ route('members.update', $member->id) }}" method="POST"> 
                @csrf 
                @method("PUT")
                <br>
                Nombre: <input type="text" name="nombre" id="nombre" value="{{ $member->nombre ?? '' }}">
                <br><br>
                Apellidos: <input type="text" name="apellidos" id="apellidos" value="{{ $member->apellidos ?? '' }}">
                <br><br>
                Dirección: <input type="text" name="direccion" id="direccion" value="{{ $member->dirección ?? '' }}">
                <br><br>
                Teléfono: <input type="text" name="telefono" id="telefono" value="{{ $member->telefono ?? '' }}">
                <br><br>
                Email: <input type="text" name="email" id="email" value="{{ $member->email ?? '' }}">
                <br><br>
                Tratamiento: <input type="text" name="tratamiento" id="tratamiento" value="{{ $center->tratamiento ?? '' }}">
                <br><br>
                Fecha: <input type="text" name="fecha" id="fecha" value="{{ $center->tratamiento ?? '' }}">
                <br><br>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
            <br>

            <div>
        <div>
    <div>

@stop