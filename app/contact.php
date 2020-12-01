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
        'statusMigratory',
        'name2',
        'relationship2',
        'telephone2',
        'city2',
        'statusMigratory',
        'id_procedure'        
    ];
}
