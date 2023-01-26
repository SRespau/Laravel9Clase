<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    
    //RELACION 1-1 con la tabla order. 1 cliente solo tiene 1 pedido
    public function orders(){
        /*hasOne -> Para relaciones 1:1. Cliente TIENE 1 pedido, que está en la tabla orders (client_id)
        HasOne() se pone en la tabla padre(la que mueve la id). Belongs() si fuera la tabla hija
        return $this->hasOne(Order::class);*/

        //hasMany() -> para relaciones 1:n. 1 Cliente puede tener varios pedidos de la tabla Orders
        //return $this->hasMany(Order::class);


        //BelongsToMany() -> Para relaciones N:M
        return $this->belongsToMany(Order::class);
    }


}
