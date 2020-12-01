<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class background extends Model
{
    //
    protected $table = 'background';
    protected $fillable = [
        'legal',
        'timeAprox1',
        'date1',
        'timeAprox2',
        'date2',
        'timeAprox3',
        'date3',
        'timeAprox4',
        'date4',
        'timeAprox5',
        'date5',
        'id_customer',
        'bacVisitEU'
    ];
}
