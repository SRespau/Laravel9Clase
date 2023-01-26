@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <h1>Detalle Producto</h1>
            <br>
            
            <a class="btn btn-primary" href="{{route('products.index')}}">Lista Productos</a>
            <br><br>
            <table class="table table-striped">
                <tr>
                    <th><b>Nombre</b></th>
                    <th>Precio</th>
                    <th>Descripcion</th>
                    <th></th>
                    <th></th>
                </tr>
                
                <tr>
                    <td>{{ $product->nombre }}</td>
                    <td>{{ $product->precio }}</td>
                    <td>{{ $product->descripcion }}</td>

                    <td>
                        <a class="btn btn-primary" href="{{route('products.edit', $product->id)}}">Editar</a>
                    </td>                    

                    <td>
                        <form action="{{route('products.destroy', $product->id)}}" method="post">
                            @csrf
                            @method("DELETE")

                            <button type="submit" class="btn btn-warning">Borrar</button>
                        </form>
                    </td>

                </tr>
                
            </table>
        <div>
    <div>
<div>

@stop

