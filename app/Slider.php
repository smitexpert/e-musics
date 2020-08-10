<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'name',
        'title',
        'content',
        'button_text',
        'image'
    ];
}
