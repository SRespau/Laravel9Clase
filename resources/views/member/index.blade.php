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
            
            <h1 style="text-align: center;">Lista de Socios</h1>
            <br>
            
            @can("create", App\Models\Member::class) 
            <a class="btn btn-primary" href="{{route('members.create')}}">Nuevo Socio</a>
            @endcan
            <br><br>

            <table class="table table-striped">
                <tr style="text-align: center;">
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripcion</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($memberList as $member)
                <tr>
                    <td>{{ $member->nombre }}</td>
                    <td>{{ $member->apellidos }}</td>
                    <td>{{ $member->direccion }}</td>
                    <td>{{ $member->telefono }}</td>
                    <td>{{ $member->email }}</td>

                    <td>
                    {{--Can comprueba si el usuario tiene politicas para relizar esos metodos--}}
                    {{--Politica para decirle que si el usuario puede actualizarlo le aparecerá el botón--}}
                    @can("update", $member)  
                        <a class="btn btn-primary" href="{{route('members.edit', $member->id)}}">Editar</a>
                    @endcan
                    </td>

                    <td>
                    {{--Politica para decirle que si el usuario puede verlo le aparecerá el botón--}}
                    @can("view", $member)    
                        <a class="btn btn-primary" href="{{route('members.show', $member->id)}}">Ver</a>
                    @endcan
                    </td>

                    <td>
                        <form action="{{route('members.destroy', $member->id)}}" method="post">
                            @csrf
                            @method("DELETE")

                            {{--Si no ponemos limitación de productos que puede modificar solamente con "delete" valdría. Sino sería @can("delete", $product)--}}
                            @can("delete", $member) 
                            <button type="submit" class="btn btn-warning">Eliminar</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        <div>
    <div>
<div>

@stop

