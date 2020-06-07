<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Optix\Media\HasMedia;

class Post extends Model
{
    use HasMedia;

    protected $fillable = [
        'title', 'author_id', 'poll_id', 'type_id', 'position_id', 'status',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
