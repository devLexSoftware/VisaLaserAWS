<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryJob extends Model
{
    protected $table = 'HistoryJob';
    protected $fillable = [
        'history',
        'companyName',
        'companyPhone',
        'companyAdress',
        'bossName',
        'dateStart',
        'note',
        'id_customer'
    ];
}
