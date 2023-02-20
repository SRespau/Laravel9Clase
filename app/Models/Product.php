<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;
    //Esto de abajo daba error al hacer el request->all() en el metodo crear de productController. Había que añadirlo para que no de error
    protected $fillable = ["nombre", "descripcion", "precio"]; //Esto me permite asignar en masa


    //Mutadores. Establecemos una regla para cambiar la cadena antes de insertarla en la bbdd
    //mutator -> set<nombre_atributo>Attribute
    //Accessor -> get


    //Sintaxis vieja
    public function setNombreAttribute($value)
    {
        //Ponemos nombre, es la columna de productos que queremos modificar
        $this->attributes['nombre'] = ucfirst(strtolower($value)); //Pasamos toda la cadena a minusculas y la primera la ponemos en mayusculas (ucfirst)
    }

    //Sintaxis nueva para laravel 9
    protected function Nombre(): Attribute
    {
        return new Attribute(
            fn ($value) => strtoupper($value), // get (se ve en mayusculas cuando se pide)
            fn ($value) => ucfirst(strtolower($value)), //set (Lo añade la primera en mayuscula y siguientes en minusuculas al insertarlo en la bbdd)
        );
    }



    //Devolución campo nombre en mayusculas
    public function getNombreAttribute($value)
    {
        return strtoupper($value);
    }

    //Campo calculado. Cobe el nombre y se queda los 5 primeros caracteres y los devuelve
    public function getNombreCortoAttribute()
    {
        return substr($this->nombre, 0, 5);
    }
}
