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

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class); // Assuming department_id exists, otherwise it returns null
    }
}
