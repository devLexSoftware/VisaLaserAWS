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
        'id_procedure',
            'purpose',
            'planning', 
            'numReservation',    
            'dateReservation',
            'visitCities',    
            'adressContact', 
            'nameContact', 
            'relationContact',
            'phoneContact', 
            'situationContact',
            'time', 
            'payName', 
            'payRelation', 
            'payPhone', 
            'payAdress', 
            'companionName',
            'companionRelation',
            'traVisitContactQues',
            'traPaymeQues',
            'traFriendQues',
            'arreglo'
    ];
}
