<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['question', 'answer', 'sort_order', 'status'];

    protected function casts(): array
    {
        return ['status' => 'boolean'];
    }
}
