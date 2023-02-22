@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <h1>Alta de Socio</h1>
            <br>
            @if(isset($errores))
            <div class="alert alert-danger" style="width: 30%;">
                <h5>{{$errores}}</h5>
            </div>
            @endif


            @if($errors->any())

            <div class="alert alert-danger" style="width: 30%;">
                <h5>Por favor, corrige los siguientes errores:</h5>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('members.store') }}" method="post">
                @csrf

                <br>
                Nombre: <input type="text" name="nombre" id="nombre">
                <br><br>
                Apellidos: <input type="text" name="apellidos" id="apellidos">
                <br><br>
                Dirección: <input type="text" name="direccion" id="direccion">
                <br><br>
                Teléfono: <input type="text" name="telefono" id="telefono">
                <br><br>
                Email: <input type="text" name="email" id="email">
                <br><br>

                <fieldset>
                    <legend>Cita Nueva</legend>
                    Centros:
                    <select name="center_id">
                        <option selected>--</option>
                        <optgroup label="Centros Estetica"></optgroup>
                        @foreach($esteticas as $estetica )
                        <option value="{{ $estetica-> id}}" name="estetica_id" id="estetica_id">{{ $estetica-> nombre }}</option>
                        @endforeach
                        <optgroup label="Peluquerías"></optgroup>
                        @foreach($centros as $centro)
                        <option value="{{ $centro -> id}}" name="hairdresser_id" id="hairdresser_id">{{ $centro-> nombre }}</option>
                        @endforeach
                    </select>
                    <br><br>

                    Tratamiento:
                    <select name="treatment_id">
                        <option selected>--</option>
                        @foreach($treatments as $treatment)
                        <option value="{{ $treatment-> id}}" name="treatment_id" id="treatment_id">{{ $treatment->nombre }}</option>
                        @endforeach
                    </select>
                    <br><br>
                    Fecha: <input type="date" name="fecha" id="fecha">
                    <br><br>
                </fieldset>

                <button type="submit" class="btn btn-success">Crear Socio Nuevo</button>
                <a class="btn btn-primary" style="width:100px;" href="{{route('members.index')}}">Volver</a>
            </form>
            <br>

        </div>
    </div>
</div>

@stop