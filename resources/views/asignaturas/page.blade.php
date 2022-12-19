@extends("layouts.master")<!--Coge la página master.blade.php en layouts-->

@section("title", "Pagina de Informacion")

@section("widget")<!--Redefinimos widget del padre-->
    @parent <!--Que coja el contenido de la sección en la página padre-->
    <h4>Esto es un añadido</h4>
@stop

@section("mainContent")
    @parent
<img src="../../../storage/images/11076649_0.jpg" alt="imagen gatico"> <!--https://stackoverflow.com/questions/36441679/how-do-i-add-images-in-laravel-view-->
@stop

@section("secundaryContent")<!--Todo yield en la página padre se ha de crear como un section en las páginas hija-->