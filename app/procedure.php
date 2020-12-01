<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class procedure extends Model
{
    //
    protected $table = 'procedure';
    protected $fillable = [
        'birthplace',
        'civilStatus',
        'homephone',
        'address',
        'visaType',
        'passport',
        'passportCity',
        'passportExpedition',
        'passportExpiration',
        'id_customer',
        'id_procedurestatus',
        'passportSate',
        'solicitante',
        'visaDelivery',
        'visaNum',
        'visaNeg',
        'visaLostDate',
        'visaLostDes',
        'deportee',
        'deporteeDate',
        'ocupation',
        'prvVisaLostQues',
        'prvDeporteeQues'
    ];
}
