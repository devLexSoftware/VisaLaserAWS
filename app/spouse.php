<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class spouse extends Model
{
    //
    protected $table = 'spouse';
    protected $fillable = [
        'name',
        'birthday',
        'birthplace',
        'living',
        'divorciedDate',
        'marryDate',
        'adress',
        'description',
        'id_procedure'
    ];
}
