<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class parents extends Model
{
    //
    protected $table = 'parent';
    protected $fillable = [
        'nameMother',
        'statusMigratoryMother',
        'birthdayMother',
        'nameFather',
        'statusMigratoryFather',
        'birthdayFather',
        'liveUSAFather',
        'liveUSAMother',
    ];
}
