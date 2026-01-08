<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class GeneralSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'order',
        'is_active',
        'created_by',
        'updated_by'
    ];

    protected static function booted()
    {
        static::saved(fn() => Cache::forget('app_settings'));
        static::deleted(fn() => Cache::forget('app_settings'));
    }
}
