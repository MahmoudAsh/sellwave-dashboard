<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'instagram_handle',
        'message_content',
        'product_id',
        'quantity',
        'status',
        'price'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'text-yellow-600 bg-yellow-100',
            'in_progress' => 'text-blue-600 bg-blue-100',
            'completed' => 'text-green-600 bg-green-100',
            'cancelled' => 'text-red-600 bg-red-100',
            default => 'text-gray-600 bg-gray-100'
        };
    }

    public function getTotalAmountAttribute()
    {
        return $this->quantity * $this->price;
    }

    public function getFormattedTotalAttribute()
    {
        return '$' . number_format($this->total_amount, 2);
    }

    public function getInstagramLinkAttribute()
    {
        return 'https://instagram.com/' . ltrim($this->instagram_handle, '@');
    }
} 