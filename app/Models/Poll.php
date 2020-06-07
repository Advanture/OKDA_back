<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = [
        'title', 'description'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //todo: m-to-m questions ( from questions m-to-m to answers )
}
