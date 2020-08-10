<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'method',
        'amount',
        'transection_id',
        'status'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
