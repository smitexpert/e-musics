<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentTwo extends Model
{
    protected $fillable = ['title', 'sub_title', 'content', 'button_text'];
}
