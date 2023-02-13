@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <h1>Editar Usuario</h1>
            <br>           

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

            <form action="{{ route('users.update', $user->id) }}" method="POST"> <!-- Tambien puede ser como Ruta + array asociativo (mas correcto) {{ route('products.update', ['product' => $product->id ]) }}-->
                @csrf <!--Hay que ponerlo para que no de error 404. Medida de seguridad-->
                @method("PUT") <!--Indicamos que es metodo PUT para el edit-->
                <br>
                Nombre: <input type="text" name="nombre" id="nombre" value="{{ $user->name ?? '' }}"> <!--Operador ternario BLADE. En caso de no encontrar nombre que ponga el campo vacio ''-->
                <br><br>
                Email: <input type="email" name="email" id="email" value="{{ $user->email ?? '' }}">
                <br><br>                
                
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
            <br>

            <div>
        <div>
    <div>

@stop