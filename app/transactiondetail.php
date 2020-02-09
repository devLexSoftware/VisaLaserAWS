<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transactiondetail extends Model
{
    //
    protected $table = 'transactiondetail';
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'payment',
        'id_transaction'        
    ];
}
