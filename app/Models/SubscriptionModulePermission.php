<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionModulePermission extends Model
{
    use HasFactory;
    protected $fillable=[
        'subscription_id',
        'module_id',
        'read',
        'add',
        'edit',
        'delete'
    ];


    // protected $connection = 'dynamicDB';
}
