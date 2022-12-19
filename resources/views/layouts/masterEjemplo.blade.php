<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("titulo")</title><!--Con yield le digo que esto es una plantilla. Si hay una página que utilice la plantilla va a tener una variable titulo que insertar si o si.-->
    <!--Se podría usar variables para que lo coja la pagina hija < ?php $titulo="Este es el titulo"; ?>;-->
</head>
<body>

    @section("widget")
        <h3>Aqui iria un widget</h3>
    @show

    
    @section("mainContent") <!--Section para definir contenido. Le damos un nombre a la sección creada (mainContent en este caso)-->
        <h2>Este es el contenido principal</h2>
        <table>
            <tr><td>Contenido tabla</td></tr>
        </table>
    @show<!--El show sirve para delimitar el fin de la seccion y para mostrarla también-->

    <div>
        @yield("secundaryContent")<!--Creamos un contenido con yield que no hace falta rellenar. Solo las páginas que hereden tendrán que rellenar la zona-->
    </div>


</body>
</html>