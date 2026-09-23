<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_code', 'name', 'department_id', 'test_category_id', 
        'specimen_type', 'container', 'price', 'cost', 
        'turnaround_time', 'status'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function parameters()
    {
        return $this->hasMany(TestParameter::class)->orderBy('sort_order');
    }
}
