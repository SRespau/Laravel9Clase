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
            <h1 style="text-align: center;">Lista de clientes</h1>
            <br>

            <a class="btn btn-primary" href="{{route('clients.create')}}">Nuevo Cliente</a>
            <br><br>
            <table class="table table-striped">
                <tr style="text-align: center;">
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($clientList as $client)
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
                        <a class="btn btn-primary" href="{{route('clients.show', $client->id)}}">Ver</a>
                    </td>

                    <td>
                        <form action="{{route('clients.destroy', $client->id)}}" method="post">
                            @csrf
                            @method("DELETE")

                            <button type="submit" class="btn btn-warning">Borrar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        <div>
    <div>
<div>

@stop

