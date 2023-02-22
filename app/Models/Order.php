<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    use HasFactory;

    public function client(){
        //Tal como hemos explicado en la tabla Client, aqui pondremos BelongsTo() ya que es la tabla hija y pertenece a cliente
        
        //return $this->belongsTo(Client::class);
        //En las relaciones 1:n se deja como está, la relación es la misma


        //Para relaciones N:M
        return $this->belongsToMany(Client::class);
    }

    //cambiar un campo fecha en particular
    //protected $casts = ["fecha" => "datetime: d-m-Y"];


    //Sintaxis laravel 9 para modificar 1 campo en particular
    public function Fecha(): Attribute{ //nombre de la función -> nombre del campo de la tabla
        return new Attribute(
            fn ($value) => Carbon::parse($value)->format("d-m-Y"), //get, a la hora de recuperarlo (visualizarlo)
            //fn ($value) => Carbon::parse($value)->format("d/m/Y"), //set, a la hora de guardarlo
        );
    }

    //Modificar campos de fecha en general (en este caso fecha, created_at, updated_at)
    //protected $dateFormat = "d-m-Y H:i:s";
}
