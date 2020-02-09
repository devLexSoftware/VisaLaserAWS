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
        'description',
        'id_procedure'
    ];
}
