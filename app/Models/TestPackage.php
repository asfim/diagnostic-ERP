<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestPackage extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'price', 'discount_price',
        'image', 'status', 'sort_order'
    ];

    public function items()
    {
        return $this->hasMany(TestPackageItem::class);
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'test_package_items', 'test_package_id', 'test_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function getSavingsAttribute()
    {
        return $this->price - ($this->discount_price ?? $this->price);
    }
}
