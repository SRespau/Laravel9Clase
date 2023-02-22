@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h1>Alta de Cita</h1>
            <br>

            @if(isset($errores))
            <div class="alert alert-danger" style="width: 30%;">
                <h5>{{$errores}}</h5>
            </div>
            @endif

            <form action="{{ route('membersTreatments.store') }}" method="post">
                @csrf

                <input type="hidden" id="member_id" name="member_id" value="{{ $member -> id}}">

                Centros:
                <select name="center_id">
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
                    @foreach($treatments as $treatment)
                    <option value="{{ $treatment-> id}}" name="treatment_id" id="treatment_id">{{ $treatment->nombre }}</option>
                    @endforeach
                </select>
                <br><br>
                Fecha: <input type="date" name="fecha" id="fecha">
                <br><br>

                <button type="submit" class="btn btn-success">Crear Cita Nueva</button>
                <a class="btn btn-primary" href="{{route('members.show', $member->id)}}">Volver</a>
            </form>
            <br>

        </div>
    </div>
</div>

@stop