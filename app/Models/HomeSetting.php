<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    protected $fillable = ['key', 'value'];

    protected $casts = [
        'value' => 'array',
    ];

    public static function getSection($key, $default = [])
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }
}
