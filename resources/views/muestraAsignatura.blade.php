<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>INFORMACIÓN DE LAS ASIGNATURAS... O ALGO ASÍ, NO SÉ.</h1>
    <table>
        <tr>
            <th>Nombre módulo</th>
            <td>{{$nombreModulo}}</td> <!--En html con php pondríamos codígo php para recoger la variable. Esto es codigo BLADE. Para mostrar la variable se pone entre 2 llaves-->
            <!--Le estamos pasando las variables en AppEjemplo.php al llamar a la vista.-->
        </tr>
        <tr>
            <th>Ciclo</th>
            <td>{{$ciclo}}</td>
        </tr>
    </table>
    <!--En BLADE podemos añadir comandos con @-->
    @if ($nombreModulo == "Memelogía")
        <p>Estoy en Entorno Memelogo</p>
    @else
        <p>Estoy en la calle</p>
    @endif

    <!--El 3º dato traido es una array. Con lo que hay que recorrerla con forEach si o si-->
    <h4>Departamento y ubicación del mismo</h4>
    @foreach ($departamentos as $dpto)
        {{$dpto}} <br>
    @endforeach

    <!--O también para sacar la clave y el valor por separado-->
    <h4>Departamento y ubicación del mismo</h4>
    @foreach ($departamentos as $key => $dpto)
        {{$key}}<br>
        {{$dpto}}<br>
    @endforeach
</body>
</html>