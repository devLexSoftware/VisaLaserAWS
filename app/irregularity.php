<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class irregularity extends Model
{
    //
    protected $table = 'irregularity';
    protected $fillable = [
        'tentativeDate',
        'durationTravel',
        'expeditionDate',
        'expeditionAproxDate',
        'denyDate',
        'denyDescription'        ,
        'stolenDate',
        'stolenDescription',
        'countriesTravel',
        'languages',
        'descriptionArrested',
        'descriptionCancelled',
        'descriptionDisease',
        'descriptionTraining',
        'descriptionOrganizedCrime',
        'id_procedure'

    ];
}
