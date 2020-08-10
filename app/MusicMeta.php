<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MusicMeta extends Model
{
    protected $fillable = [
        'music_id',
        'meta_name',
        'meta_id'
    ];
}
