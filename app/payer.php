<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payer extends Model
{
    //
    protected $table = 'payer';
    protected $fillable = [
        'name',
        'relationship',
        'telephone',
        'city',
        'id_procedure'        
    ];
}
