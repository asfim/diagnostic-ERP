<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'icon', 'image', 'status'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
