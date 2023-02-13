@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!--Con este if obtenemos el with del ProductController, donde ponemos los mensajes de exito una vez redirigimos al terminar un metodo-->
            @if($message = Session::get("exito")) {{--Como es sesiones podriamos poner session()->get("exito")--}}
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>
            @endif

            
            {{--{{ dd(session()->all()) }}--}} {{--Muestra la info de la sesion--}}
            {{--{{ session(["contador" => "0"]) }} --}}
            <h4>El contador de acceso a "Ver" es: {{ session("contador") }}</h4>
            <h1 style="text-align: center;">Lista de productos</h1>
            <br>
            
            {{-- Asi importamos el use y en create solo haría falta poner Product::class
            @php
                use App\Models\Product
            @endphp
            --}}
            @can("create", App\Models\Product::class) 
            <a class="btn btn-primary" href="{{route('products.create')}}">Nuevo Producto</a>
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
                @foreach($productList as $product)
                <tr>
                    <td>{{ $product->nombre }}</td>
                    <td>{{ $product->precio }}</td>
                    <td>{{ $product->descripcion }}</td>

                    <td>
                    {{--Can comprueba si el usuario tiene politicas para relizar esos metodos--}}
                    {{--Politica para decirle que si el usuario puede actualizarlo le aparecerá el botón--}}
                    @can("update", $product)  
                        <a class="btn btn-primary" href="{{route('products.edit', $product->id)}}">Editar</a>
                    @endcan
                    </td>

                    <td>
                    {{--Politica para decirle que si el usuario puede verlo le aparecerá el botón--}}
                    @can("view", $product)    
                        <a class="btn btn-primary" href="{{route('products.show', $product->id)}}">Ver</a>
                    @endcan
                    </td>

                    <td>
                        <form action="{{route('products.destroy', $product->id)}}" method="post">
                            @csrf
                            @method("DELETE")

                            {{--Si no ponemos limitación de productos que puede modificar solamente con "delete" valdría. Sino sería @can("delete", $product)--}}
                            @can("delete", $product) 
                            <button type="submit" class="btn btn-warning">Borrar</button>
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

