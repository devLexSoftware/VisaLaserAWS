<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class travel extends Model
{
    //
    protected $table = 'travel';
    protected $fillable = [
        'date',
        'duration',
        'country',
        'state',
        'id_procedure'
    ];
}
