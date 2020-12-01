<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalInfo extends Model
{
    //
    protected $table = 'AdditionalInfo';
    protected $fillable = [
        'visitCountry',  
        'weapons',
        'weaponsInfo',
        'serviceMilitaire',
        'languages',  
        'facebook', 
        'flickr', 
        'google', 
        'instagram', 
        'linkedin', 
        'myspace', 
        'tumblr', 
        'twitter', 
        'vine', 
        'youtube', 
        'pinterest', 
        'reddit', 
        'arrested',
        'id_customer'
    ];
}
