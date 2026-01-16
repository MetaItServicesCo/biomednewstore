<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'email',
        'first_name',
        'last_name',
        'company',
        'street_address',
        'street_address_2',
        'state_id',
        'city_id',
        'postal_code',
        'country_id',
        'phone_number',
        'subtotal',
        'shipping',
        'tax',
        'gst',
        'total',
        'shipping_method',
        'payment_status',
        'stripe_payment_intent_id',
        'payment_error_message',
        'order_status',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ===========================
    // Relationships
    // ===========================
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // ===========================
    // Scopes
    // ===========================

    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('payment_status', 'completed');
    }

    public function scopeFailed($query)
    {
        return $query->where('payment_status', 'failed');
    }
}
