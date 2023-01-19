@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <h1>Editar Producto</h1>
            <br>

            <a class="btn btn-primary" href="{{route('products.index')}}">Lista Productos</a>

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

            <form action="{{ route('products.update', $product->id) }}" method="POST"> <!-- Tambien puede ser como Ruta + array asociativo (mas correcto) {{ route('products.update', ['product' => $product->id ]) }}-->
                @csrf <!--Hay que ponerlo para que no de error 404. Medida de seguridad-->
                @method("PUT") <!--Indicamos que es metodo PUT para el edit-->
                <br>
                Nombre: <input type="text" name="nombre" id="nombre" value="{{ $product->nombre ?? '' }}"> <!--Operador ternario BLADE. En caso de no encontrar nombre que ponga el campo vacio ''-->
                <br><br>
                Precio: <input type="text" name="precio" id="precio" value="{{ $product->precio ?? '' }}">
                <br><br>
                Descripción: <input type="text" name="descripcion" id="descripcion" value="{{ $product->descripcion ?? '' }}">
                <br>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
            <br>

            <div>
        <div>
    <div>

@stop