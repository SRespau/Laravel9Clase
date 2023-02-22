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