<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionCharges extends Model
{
    use HasFactory;
    protected $table='subscription_charges';
    protected $fillable=['subscription_id','amount','tenure','from_date','to_date'];
    public function plan(){
        return $this->belongsTo(Subscription::class);
    }

    // protected $connection = 'dynamicDB';
}
