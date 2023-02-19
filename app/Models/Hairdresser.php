<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hairdresser extends Model
{
    use HasFactory;
    protected $fillable = ["nif", "nombre", "razon_social", "direccion", "email", "telefono", "unisex", "maximo_personas"];
}