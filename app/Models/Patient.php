<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'name', 'photo', 'gender', 'dob', 'age', 
        'blood_group', 'mobile', 'email', 'nid', 'guardian_name', 
        'guardian_mobile', 'address', 'emergency_contact', 'notes'
    ];
}
