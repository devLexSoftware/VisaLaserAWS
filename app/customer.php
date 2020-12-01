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
        'lastNameMother',
        'sex',
        'telephone',
        'birthday',
        'address',
        'street',
        'subur',
        'numExt',
        'numInt',
        'cp',
        'city',
        'state',
        'workphone',
        'movil'        
    ];
}
