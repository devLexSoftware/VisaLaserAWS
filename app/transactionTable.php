<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transactionTable extends Model
{
    //
    protected $table = 'transaction';
    protected $fillable = [
        'currency',
        'datetime',
        'status',
        'id_customer'        
    ];
}
