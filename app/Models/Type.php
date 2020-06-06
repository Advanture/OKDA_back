<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'title', 'description'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
