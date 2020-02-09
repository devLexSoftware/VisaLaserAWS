<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    //
    protected $table = 'customer';
    protected $fillable = [
        'firstName',
        'lastName',
        'sex',
        'telephone',
        'birthday',
        'address'        
    ];
}
