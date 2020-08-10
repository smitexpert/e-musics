<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Music extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'duration',
        'cover'
    ];

    public function album()
    {
        return $this->hasOneThrough(
            'App\Album',
            'App\MusicMeta',
            'music_id',
            'id',
            'id',
            'meta_id'
        )->where('meta_name', 'album');
    }

    public function artist()
    {
        return $this->hasOneThrough(
            'App\Artist',
            'App\MusicMeta',
            'music_id',
            'id',
            'id',
            'meta_id'
        )->where('meta_name', 'artist');
    }

    public function genre()
    {
        return $this->hasOneThrough(
            'App\Genre',
            'App\MusicMeta',
            'music_id',
            'id',
            'id',
            'meta_id'
        )->where('meta_name', 'genre');
    }

    public function playlist()
    {
        return $this->hasOneThrough(
            'App\Album',
            'App\MusicMeta',
            'music_id',
            'id',
            'id',
            'meta_id'
        )->where('meta_name', 'playlist');
    }
}
