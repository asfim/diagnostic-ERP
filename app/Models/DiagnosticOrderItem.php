<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosticOrderItem extends Model
{
    protected $fillable = [
        'diagnostic_order_id', 'test_id', 'price', 'status'
    ];

    public function order()
    {
        return $this->belongsTo(DiagnosticOrder::class, 'diagnostic_order_id');
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
