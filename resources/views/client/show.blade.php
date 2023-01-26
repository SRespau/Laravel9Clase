@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <h1>Detalle Cliente</h1>
            <br>
            
            <a class="btn btn-primary" href="{{route('clients.index')}}">Lista Clientes</a>

            <table class="table table-striped">
                <tr>
                    <th><b>DNI</b></th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </tr>
                
                <tr>
                    <td>{{ $client->dni }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->surname }}</td>
                    <td>{{ $client->phoneNumber }}</td>
                    <td>{{ $client->email }}</td>
                    
                    <td>
                        <a class="btn btn-primary" href="{{route('clients.edit', $client->id)}}">Editar</a>
                    </td>                    

                    <td>
                        <form action="{{route('clients.destroy', $client->id)}}" method="post">
                            @csrf
                            @method("DELETE")

                            <button type="submit" class="btn btn-warning">Borrar</button>
                        </form>
                    </td>

                </tr>
                
            </table>
            <br><br>
            
            <h3>Pedidos Realizados</h3>
            @foreach($orders as $order)
            <table class="table table-striped">              
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Fecha</th>
                    <th>Descripción</th>                    
                </tr>                
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->producto }}</td>
                    <td>{{ $order->fecha }}</td>
                    <td>{{ $order->descripcion }}</td>
                </tr>                
            </table>
            @endforeach
        <div>
    <div>
<div>

@stop

