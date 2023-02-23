@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

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
                    <th>Apellidos</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
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

                        @can("update", $member)
                        <a class="btn btn-primary" href="{{route('members.edit', $member->id)}}">Editar</a>
                        @endcan
                    </td>

                    <td>

                        @can("view", $member)
                        <a class="btn btn-primary" href="{{route('members.show', $member->id)}}">Ver</a>
                        @endcan
                    </td>

                    <td>
                        <form action="{{route('members.destroy', $member->id)}}" method="post">
                            @csrf
                            @method("DELETE")

                            @can("delete", $member)
                            <button type="submit" onclick="return confirm('Confirmar eliminación')"class="btn btn-warning">Eliminar</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
           <!-- <div style="text-align:center;">{{ $memberList->links() }}</div>   -->         
            
        </div>
    </div>
</div>

@stop