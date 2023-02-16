<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    //Esto de abajo daba error al hacer el request->all() en el metodo crear de productController. Había que añadirlo para que no de error
    protected $fillable = ["nombre", "descripcion", "precio"]; //Esto me permite asignar en masa


    //Mutadores. Establecemos una regla para cambiar la cadena antes de insertarla en la bbdd
    //mutator -> set<nombre_atributo>Attribute
    //Accessor -> get

    public function setNombreAttribute($value)
    {
        //Ponemos nombre, es la columna de productos que queremos modificar
        $this->attributes['nombre'] = ucfirst(strtolower($value)); //Pasamos toda la cadena a minusculas y la primera la ponemos en mayusculas (ucfirst)
    }


    //Devolución campo nombre en mayusculas
    public function getNombreAttribute($value)
    {        
        return strtoupper($value); 
    }


    //Ejercicio coger el precio y lo muestre con la palabra euros
    public function getPrecioAttribute($value)
    {        
        return ($value . "€"); 
    }
}
