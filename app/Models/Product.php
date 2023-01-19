<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    //Esto de abajo daba error al hacer el request->all() en el metodo crear de productController. Había que añadirlo para que no de error
    protected $fillable = ["nombre", "descripcion", "precio"]; //Esto me permite asignar en masa
}

