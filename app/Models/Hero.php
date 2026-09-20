<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = ['title', 'subtitle', 'image', 'bg_image', 'overlay_color', 'button_text', 'button_link', 'status'];
}
