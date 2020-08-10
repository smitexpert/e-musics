<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'slug',
        'image_id'
    ];

    public function image()
    {
        return $this->hasOne('App\Image', 'id', 'image_id');
    }

    public function musics()
    {
        return $this->hasManyThrough(
            'App\Music',
            'App\MusicMeta',
            'meta_id',
            'id',
            'id',
            'music_id'
        )->where('meta_name', 'album');
    }
}
