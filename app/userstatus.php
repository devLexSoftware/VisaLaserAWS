<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userstatus extends Model
{
    //
    protected $table = 'userstatus';
    protected $fillable = [
        'status',
        'code',
        'description'        
    ];
}
