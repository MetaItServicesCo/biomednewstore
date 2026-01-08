<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyProductForm extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'email',
        'state_id',
        'city_id',
        'message',
        'ip_address',
        'user_agent',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
