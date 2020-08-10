<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'music_id',
        'comment'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
