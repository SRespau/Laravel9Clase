<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AestheticCenter extends Model
{
    use HasFactory;
    protected $fillable = ["nif", "nombre", "razon_social", "direccion", "email", "telefono", "servicio_fisio", "num_salas"];

    protected $primaryKey = 'id';

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';
}