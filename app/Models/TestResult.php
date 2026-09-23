<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnostic_order_id', 'test_id', 'patient_id', 
        'result_value', 'remarks', 'status'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function diagnosticOrder()
    {
        return $this->belongsTo(DiagnosticOrder::class);
    }

    public function values()
    {
        return $this->hasMany(TestResultValue::class);
    }
}
