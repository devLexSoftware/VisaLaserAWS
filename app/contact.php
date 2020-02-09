<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    //
    protected $table = 'contact';
    protected $fillable = [
        'name',
        'relationship',
        'telephone',
        'city',
        'id_procedure'        
    ];
}
