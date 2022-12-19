@extends("layouts.master")


@section("title", "Alta Asignaturas")


@section("encabezado")
    Alta de asignaturas
@stop


@section("cuerpo")
    @parent
    <br>
    Completa el siguiente formulario:


<!--Se puede poner la ruta a mano, pero mejor poner route para que redirija ahi-->
<form action="{{route('asignaturas.store')}}" method="post">

<label for="nombre">Nombre</label><br>
<input type="text" name="nombre">
<br>
<label for="curso">Curso</label><br>
<input type="text" name="curso">
<br>
<label for="ciclo">Ciclo</label><br>
<input type="text" name="ciclo">
<br>
<label for="comentarios">Comentarios</label><br>
<textarea name="comentarios" id="comentarios" cols="20" rows="5" placeholder="Escribe aqui"></textarea>

@stop


@section("accionFormulario")
Enviar
@stop

</form>

