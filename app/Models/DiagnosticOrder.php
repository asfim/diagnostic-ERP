<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiagnosticOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'patient_id', 'doctor_id', 'order_date', 
        'total_amount', 'discount', 'paid_amount', 'due_amount', 
        'payment_status', 'order_status'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function items()
    {
        return $this->hasMany(DiagnosticOrderItem::class);
    }
}
