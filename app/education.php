<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class education extends Model
{
    //
    protected $table = 'education';
    protected $fillable = [
        'school',
        'city',
        'admissionDate',
        'egressDate',
        'level',
        'id_procedure'        
    ];
}
