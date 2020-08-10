<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVerifyToken extends Model
{
    protected $fillable = ['email', 'token'];
}
