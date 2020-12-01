<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customermenbers extends Model
{
    //
    protected $table = 'customermenbers';
    protected $fillable = [
        'relationship',
        'email',
        'id_customer'        
    ];
}
