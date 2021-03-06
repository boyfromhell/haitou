<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaGenre extends Model
{
    public $timestamps = false;
    protected $table = 'media_genres';
    protected $casts = [
        'media_id' => 'int',
        'genre_id' => 'int'
    ];

    protected $fillable = [
        'media_id',
        'genre_id'
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }
}
