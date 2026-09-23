<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'category',
        'excerpt',
        'content',
        'image',
        'published_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'status' => 'boolean',
        ];
    }
}
