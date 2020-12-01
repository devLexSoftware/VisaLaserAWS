<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usertype extends Model
{
    //
    protected $table = 'usertype';
    protected $fillable = [
        'type',
        'code',
        'description'        
    ];
}
