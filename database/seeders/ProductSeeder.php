<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Wireless Bluetooth Headphones',
                'description' => 'Premium quality wireless headphones with noise cancellation and 30-hour battery life. Perfect for music lovers and professionals.',
                'price' => 79.99,
                'product_link' => 'https://example.com/headphones',
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=300&fit=crop',
            ],
            [
                'name' => 'Smart Fitness Watch',
                'description' => 'Track your workouts, monitor heart rate, and stay connected with this waterproof smart fitness watch.',
                'price' => 199.99,
                'product_link' => 'https://example.com/smartwatch',
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&h=300&fit=crop',
            ],
            [
                'name' => 'Portable Phone Charger',
                'description' => '10,000mAh portable battery pack with fast charging and multiple USB ports. Keep your devices powered on the go.',
                'price' => 29.99,
                'product_link' => 'https://example.com/charger',
                'image' => 'https://images.unsplash.com/photo-1609592324374-10506ce8c3b8?w=500&h=300&fit=crop',
            ],
            [
                'name' => 'Organic Coffee Beans',
                'description' => 'Premium single-origin organic coffee beans, ethically sourced and freshly roasted. Rich, smooth flavor profile.',
                'price' => 24.99,
                'product_link' => 'https://example.com/coffee',
                'image' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=500&h=300&fit=crop',
            ],
            [
                'name' => 'Minimalist Wallet',
                'description' => 'Sleek leather wallet with RFID blocking technology. Compact design holds up to 12 cards and cash.',
                'price' => 45.00,
                'product_link' => 'https://example.com/wallet',
                'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=500&h=300&fit=crop',
            ],
            [
                'name' => 'Indoor Plant Set',
                'description' => 'Collection of 3 easy-care indoor plants in decorative pots. Perfect for home or office decoration.',
                'price' => 89.99,
                'product_link' => 'https://example.com/plants',
                'image' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=500&h=300&fit=crop',
            ],
            [
                'name' => 'Yoga Mat Premium',
                'description' => 'Non-slip, eco-friendly yoga mat with extra cushioning. Includes carrying strap and alignment guides.',
                'price' => 39.99,
                'product_link' => 'https://example.com/yoga-mat',
                'image' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?w=500&h=300&fit=crop',
            ],
            [
                'name' => 'LED Desk Lamp',
                'description' => 'Adjustable LED desk lamp with touch controls, USB charging port, and eye-care lighting technology.',
                'price' => 34.99,
                'product_link' => 'https://example.com/desk-lamp',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&h=300&fit=crop',
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
} 