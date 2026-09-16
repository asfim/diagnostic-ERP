<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no', 'patient_id', 'date', 'subtotal', 'discount', 
        'total', 'paid', 'due', 'payment_status', 'payment_method'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
