@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <h1>Alta de Producto</h1>
            <br>

            <a class="btn btn-primary" href="{{route('products.index')}}">Lista Productos</a>

            @if($errors->any())  {{--Tratamos los errores del required en el método create (devuelve array de errores)--}}
            
            <div class="alert alert-danger" style="width: 30%;">
                <h5>Por favor, corrige los siguientes errores:</h5>
                <ul>
                    @foreach($errors->all() as $error)   {{--Recogo todos los errores y los muestro--}}
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('products.store') }}" method="post">   {{--Tambien puede ser como Ruta + array asociativo (mas correcto) {{ route('products.update', --}}
                @csrf   {{--Hay que ponerlo para que no de error 404. Medida de seguridad--}}
                
                <br>
                Nombre: <input type="text" name="nombre" id="nombre"> {{--Operador ternario BLADE. En caso de no encontrar nombre que ponga el campo vacio ''--}}
                <br><br>
                Precio: <input type="text" name="precio" id="precio">
                <br><br>
                Descripción: <input type="text" name="descripcion" id="descripcion">
                <br>
                <button type="submit" class="btn btn-primary">Crear producto</button>
            </form>
            <br>

            <div>
        <div>
    <div>

@stop