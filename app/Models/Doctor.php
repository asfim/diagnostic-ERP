<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id', 'user_id', 'name', 'photo', 'specialization', 
        'qualification', 'bmdc_reg', 'mobile', 'email', 'address', 
        'consultation_fee', 'status'
    ];
}
