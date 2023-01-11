<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class traffic extends Model
{
    use HasFactory;

    public $table = 'traffic_data';

    protected $fillable = [
        'DateAndTime',
        'Junction',
        'Vehicles',
        'number',
    ];
}
