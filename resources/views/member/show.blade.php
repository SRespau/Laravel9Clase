@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <h1>Detalle Socio</h1>
            <br>
            
            <a class="btn btn-primary" href="{{route('products.index')}}">Lista Productos</a>
            <br><br>
            <table class="table table-striped">
                
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                    
                </tr>
                
                <tr>
                    <td>{{ $member->nombre }}</td>
                    <td>{{ $member->apellidos }}</td>
                    <td>{{ $member->direccion }}</td>
                    <td>{{ $member->telefono }}</td>
                    <td>{{ $member->email }}</td>

                    <td>
                    @can("update", $member)
                        <a class="btn btn-primary" href="{{route('members.edit', $member->id)}}">Editar</a>
                    @endcan
                    </td>                    

                    <td>
                        <form action="{{route('members.destroy', $member->id)}}" method="post">
                            @csrf
                            @method("DELETE")
                            @can("delete", $member)
                            <button type="submit" class="btn btn-warning">Eliminar</button>
                            @endcan
                        </form>
                    </td>

                </tr>
                
            </table>
        <div>
    <div>
<div>

@stop

