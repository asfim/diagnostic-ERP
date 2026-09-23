<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeCollectionRequest extends Model
{
    protected $fillable = [
        'patient_name',
        'phone',
        'preferred_date',
        'preferred_time',
        'address',
        'tests_required',
        'status',
    ];

    protected function casts(): array
    {
        return ['preferred_date' => 'date'];
    }
}
