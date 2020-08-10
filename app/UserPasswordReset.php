<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPasswordReset extends Model
{
    protected $fillable = ['user_id', 'token'];
}
