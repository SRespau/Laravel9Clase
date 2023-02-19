<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aesthetic extends Model
{
    use HasFactory;
    protected $fillable = ["nif", "nombre", "razon_social", "direccion", "email", "telefono", "servicio_fisio", "num_salas"];
}