<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class table extends Model
{
    use HasFactory;

    public $table = 'tables';
    
    protected $fillable = [
        'tableName',
        'tableDBName',
        'colCount',
        'tableDesc',
        'details',
    ];
}
