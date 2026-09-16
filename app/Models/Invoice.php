<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
