<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    //
    protected $table = 'state';
    protected $fillable = [
        'code',
        'name',
        'id_country'        
    ];
}
