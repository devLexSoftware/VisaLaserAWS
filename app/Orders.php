<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $table = 'orders';
    protected $fillable = [
        'subtotal',
        'shipping',
        'user_id',
        'update_at'
    ];
}
