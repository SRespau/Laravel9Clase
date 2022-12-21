@extends("layouts.master")


@section("title", "Alta Asignaturas")


@section("encabezado")
    Alta de asignaturas
@stop


@section("cuerpo")
    @parent
    <br>    

    Completa el siguiente formulario:
    <br>
    @if($errors->any()) <!--Tratamos los errores del required en el método create (devuelve array de errores)-->
        <div class="alert alert-danger" style="width: 30%; margin: auto">
        <h5>Por favor, corrige los siguientes errores:</h5> 
        <ul>       
            @foreach($errors->all() as $error) <!--Recogo todos los errores y los muestro-->
                <li>{{$error}}</li>
            @endforeach
        </ul>
        </div>
    @endif

<!--Se puede poner la ruta a mano, pero mejor poner route para que redirija ahi-->
<form action="{{route('asignaturas.store')}}" method="post">
    @csrf <!--Es una directiva de seguridad (cross-site request forgery). Hay que añadirlo en formularios para que no salga "page expired" al hacer submit-->
    <!--Crea un input en hidden con un token en value aleatorio. Laravel no dejará enviar ningun formulario de cualquier tipo sin esta linea-->
<label for="nombre">Nombre</label><br>
<input type="text" name="nombre" value="{{old('nombre')}}"> <!--Con old("nombre") le decimos que mantenga el valor antiguo que tennía el campo nombre-->
<br>
<label for="curso">Curso</label><br>
<input type="text" name="curso" value="{{old('curso')}}">
<br>
<label for="ciclo">Ciclo</label><br>
<input type="text" name="ciclo" value="{{old('ciclo')}}">
<br>
<label for="comentarios">Comentarios</label><br>
<textarea name="comentarios" id="comentarios" cols="20" rows="5" placeholder="Escribe aqui"></textarea>

@stop


@section("accionFormulario")
Enviar
@stop

</form>

