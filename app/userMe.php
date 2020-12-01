<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userMe extends Model
{
    //
    protected $table = 'user';
    protected $fillable = [
        'code',
        'email',
        'password',
        'token',
        'id_userstatus',
        'id_usertype',
        'id_usercustomer',
        'remember_token'
    ];
}
