<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class job extends Model
{
    //
    protected $table = 'job';
    protected $fillable = [
        'company',
        'address',
        'ocupation',
        'activities',
        'salary',
        'carrer',
        'dateInit',
        'description',
        'id_procedure'
    ];
}
