<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentOne extends Model
{
    protected $fillable = ['title', 'content', 'button_text'];
}
