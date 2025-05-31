<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'product_link',
        'image'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    public function getTotalRevenueAttribute()
    {
        return $this->orders()
            ->where('status', 'completed')
            ->sum(\DB::raw('quantity * price'));
    }

    public function getTotalOrdersAttribute()
    {
        return $this->orders()->count();
    }
} 