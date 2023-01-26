@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <h1>Editar Cliente</h1>
            <br>

            <a class="btn btn-primary" href="{{route('clients.index')}}">Lista Clientes</a>

            @if($errors->any()) <!--Tratamos los errores del required en el método create (devuelve array de errores)-->
            
            <div class="alert alert-danger" style="width: 30%;">
                <h5>Por favor, corrige los siguientes errores:</h5>
                <ul>
                    @foreach($errors->all() as $error) <!--Recogo todos los errores y los muestro-->
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('clients.store') }}" method="POST"> {{-- Tambien puede ser como Ruta + array asociativo (mas correcto) {{ route('clients.update', ['client' => $client->id ]) }}--}}
                @csrf {{--Hay que ponerlo para que no de error 404. Medida de seguridad--}}
                
                <br>
                DNI: <input type="text" name="dni" id="dni"> <!--Operador ternario BLADE. En caso de no encontrar nombre que ponga el campo vacio ''-->
                <br><br>
                Nombre: <input type="text" name="name" id="name" > <!--Operador ternario BLADE. En caso de no encontrar nombre que ponga el campo vacio ''-->
                <br><br>
                Apellidos: <input type="text" name="surname" id="surname" >
                <br><br>
                Teléfono: <input type="text" name="phoneNumber" id="phoneNumber" >
                <br><br>
                Email: <input type="text" name="email" id="email" >
                <br><br>
                <button type="submit" class="btn btn-primary">Crear Cliente</button>
            </form>
            <br>

            <div>
        <div>
    <div>

@stop