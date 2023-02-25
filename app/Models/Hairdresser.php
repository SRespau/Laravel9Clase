<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hairdresser extends Model
{
    use HasFactory;
    protected $fillable = ["nif", "nombre", "razon_social", "direccion", "email", "telefono", "unisex", "maximo_personas"];
    
    //Estas 3 variables sirven para cambiar la id principal en laravel por string, en vez de int que coge por defecto
    protected $primaryKey = 'id';

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';
}