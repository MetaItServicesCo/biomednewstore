<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultancyForm extends Model
{
    protected $fillable = [
        'name',
        'email',
        'organization',
        'phone',
        'help',
        'message',
    ];
}
