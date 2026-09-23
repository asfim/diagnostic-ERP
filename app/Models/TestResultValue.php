<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResultValue extends Model
{
    protected $fillable = ['test_result_id', 'test_parameter_id', 'value', 'flag'];

    public function parameter()
    {
        return $this->belongsTo(TestParameter::class, 'test_parameter_id');
    }

    public function testResult()
    {
        return $this->belongsTo(TestResult::class);
    }
}
