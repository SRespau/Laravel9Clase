<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
