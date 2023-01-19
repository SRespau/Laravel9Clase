@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!--Con este if obtenemos el with del ProductController, donde ponemos los mensajes de exito una vez redirigimos al terminar un metodo-->
            @if($message = Session::get("exito"))
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>
            @endif
            <h1 style="text-align: center;">Lista de productos</h1>
            <br>

            <a class="btn btn-primary" href="{{route('products.create')}}">Nuevo Producto</a>

            <table class="table table-striped">
                <tr style="text-align: center;">
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripcion</th>
                </tr>
                @foreach($productList as $product)
                <tr>
                    <td>{{ $product->nombre }}</td>
                    <td>{{ $product->precio }}</td>
                    <td>{{ $product->descripcion }}</td>

                    <td>
                        <a class="btn btn-primary" href="{{route('products.edit', $product->id)}}">Editar</a>
                    </td>

                    <td>
                        <a class="btn btn-primary" href="{{route('products.show', $product->id)}}">Ver</a>
                    </td>

                    <td>
                        <form action="{{route('products.destroy', $product->id)}}" method="post">
                            @csrf
                            @method("DELETE")

                            <button type="submit" class="btn btn-primary">Borrar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        <div>
    <div>
<div>

@stop

