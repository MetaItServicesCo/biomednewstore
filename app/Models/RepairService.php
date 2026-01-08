<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairService extends Model
{
    protected $table = 'repair_services'; // your table name

    protected $fillable = [
        'main_heading',
        'main_short_description',
        'banner_heading',
        'banner_short_description',
        'banner_image',
        'banner_image_alt',
        'repair_service_heading',
        'x_ray_heading',
        'c_arm_heading',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'created_by',
        'updated_by',
        'repair_service_short_description',
        'x_ray_short_description',
        'c_arm_short_description',
    ];
}
