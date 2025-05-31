<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        
        if ($products->isEmpty()) {
            return;
        }

        $orders = [
            [
                'customer_name' => 'Sarah Johnson',
                'instagram_handle' => '@sarah_j_lifestyle',
                'message_content' => 'Hi! I saw your post about the wireless headphones. Can I get them in black? When do you ship?',
                'quantity' => 1,
                'status' => 'completed',
            ],
            [
                'customer_name' => 'Mike Chen',
                'instagram_handle' => '@mike_fitness',
                'message_content' => 'Hey! Interested in the smart fitness watch. Do you have it in blue? Also, does it track swimming?',
                'quantity' => 1,
                'status' => 'in_progress',
            ],
            [
                'customer_name' => 'Emma Wilson',
                'instagram_handle' => '@emmawilson_official',
                'message_content' => 'Love your coffee posts! Can I order 2 bags of the organic coffee beans?',
                'quantity' => 2,
                'status' => 'pending',
            ],
            [
                'customer_name' => 'David Rodriguez',
                'instagram_handle' => '@davidr_tech',
                'message_content' => 'That portable charger looks perfect for travel! How fast does it charge an iPhone?',
                'quantity' => 1,
                'status' => 'completed',
            ],
            [
                'customer_name' => 'Lisa Park',
                'instagram_handle' => '@lisapark_home',
                'message_content' => 'Hi! I\'m interested in the indoor plant set. Do they come with care instructions?',
                'quantity' => 1,
                'status' => 'in_progress',
            ],
            [
                'customer_name' => 'Alex Thompson',
                'instagram_handle' => '@alex_minimalist',
                'message_content' => 'The minimalist wallet looks exactly what I need! Is the leather genuine?',
                'quantity' => 1,
                'status' => 'completed',
            ],
            [
                'customer_name' => 'Jessica Martinez',
                'instagram_handle' => '@jess_yoga_life',
                'message_content' => 'Your yoga mat review was so helpful! Can I get the premium one in purple?',
                'quantity' => 1,
                'status' => 'pending',
            ],
            [
                'customer_name' => 'Tom Anderson',
                'instagram_handle' => '@tom_workspace',
                'message_content' => 'That LED desk lamp would be perfect for my home office setup. Does it have adjustable brightness?',
                'quantity' => 1,
                'status' => 'in_progress',
            ],
        ];

        foreach ($orders as $index => $orderData) {
            // Assign products cyclically
            $product = $products[$index % $products->count()];
            
            Order::create([
                'customer_name' => $orderData['customer_name'],
                'instagram_handle' => $orderData['instagram_handle'],
                'message_content' => $orderData['message_content'],
                'product_id' => $product->id,
                'quantity' => $orderData['quantity'],
                'price' => $product->price,
                'status' => $orderData['status'],
            ]);
        }
    }
} 