<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // protected $guarded = [];

    protected $fillable = [
        'property',
        'value',
    ];

    // protected $connection = 'dynamicDB';
}
