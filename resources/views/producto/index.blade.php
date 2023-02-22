@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h1 style="text-align: center;">Lista de productos</h1>
            <br>

            @can("create", App\Models\Product::class)
            <a class="btn btn-primary" href="{{route('products.create')}}">Nuevo Producto</a>
            @endcan

            {{-- para AJAX html  --}}
            <div id="tablehtml"></div>

            <div id="tablejson">
                <table id="" class="table table-bordered table-stripped">
                    <thread>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                        </tr>
                    </thread>
                    <tbody id="myTbody">
                        <tr>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--Script JS AJAX httprequest en JQuery-->
<script>
    /*
    $(document).ready(function() {
        loadDataHtml();
        //loadDataJson();
    });

    const loadDataHtml = function() {
        let url = "/productos/html";
        $.get(url, function(data, status) {
            //console.log(data)
            $("#tablehtml").html(data);
        }).fail(function(e) {
            console.log("Error " + e.status);
        });
    }
    */

    $(document).ready(function() {
        //loadDataHtml();
        loadDataJson();
    });

    const loadDataJson = function() {
        let url = "/productos/json"; //"/productos/html" para llevar codigo html
        
        $.get(url, function(data, status) {
            console.log(data);
            $("#myTbody").empty();
            Object.keys(data).forEach(function(id){
                console.log(id); //Comprobar que aparecen los datos en consola. Simplemente para ver que todo va bien
                console.log(data[id]);
                var tr = document.createElement("tr");
                tr.setAttribute("id", `tr${data[id].id}`);
                let fila ="<td>" + data[id].nombre + "</td>";
                fila += "<td>" + data[id].descripcion + "</td>";
                fila += "<td>" + data[id].precio + "</td>";
                // fila += `<td> ${link}</td`;
                // fila += `<td> ${linkDelete}</td>`;
                tr.innerHTML = fila;
                // tr.innerHTML = studentTr(id);
                $("#myTbody").append(tr);
            });
        }).fail(function(e) {
            console.log("Error " + e.status);
        });
    }
</script>

@stop