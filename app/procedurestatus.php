<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class procedurestatus extends Model
{
    //
    protected $table = 'procedurestatus';
    protected $fillable = [
        'status',
        'code'        
    ];
}
