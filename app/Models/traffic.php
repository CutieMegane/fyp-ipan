<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class traffic extends Model
{
    public $table = "trafficData";

    protected $fillable = [

        'time', 
        'weekend',
        'collisionType', 
        'injuryType', 
        'primaryFactor', 
        'reportedLocation', 
        'lat', 
        'long'

    ];
}
