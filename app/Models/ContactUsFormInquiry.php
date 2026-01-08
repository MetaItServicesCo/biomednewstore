<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUsFormInquiry extends Model
{

    protected $table = 'contact_us_form_inquiries';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'state_id',
        'city_id',
        'service',
        'message',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
