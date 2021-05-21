<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'order_name',
        'order_phone',
        'order_notes',
        'order_address',
        'user_id',
        'subtotal',
        'shipping_cost',
        'total',
        'courier',
        'tracking_number',
        'payment_method_id',
        'payment_proff_image',
        'status'
    ];
}
