<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category' => 'T-Shirt',
                'items' => [
                    ['name' => 'Premium Cotton T-Shirt', 'price' => 25.00, 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1000&auto=format&fit=crop'],
                    ['name' => 'Slim Fit V-Neck', 'price' => 19.99, 'image' => 'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?q=80&w=1000&auto=format&fit=crop'],
                ]
            ],
            [
                'category' => 'Jacket',
                'items' => [
                    ['name' => 'EliteShield Performance Jacket', 'price' => 255.00, 'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=1000&auto=format&fit=crop'],
                    ['name' => 'Wedge Performance Parka', 'price' => 180.00, 'image' => 'https://images.unsplash.com/photo-1495105787522-5334e3ffa0ef?q=80&w=1000&auto=format&fit=crop'],
                ]
            ],
            [
                'category' => 'Shoes',
                'items' => [
                    ['name' => 'Urban Runner Sneakers', 'price' => 85.00, 'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1000&auto=format&fit=crop'],
                    ['name' => 'Leather Chelsea Boots', 'price' => 120.00, 'image' => 'https://images.unsplash.com/photo-1520639889313-7272a74b1c73?q=80&w=1000&auto=format&fit=crop'],
                ]
            ],
            [
                'category' => 'Bag',
                'items' => [
                    ['name' => 'OptiZoom Camera Bag', 'price' => 250.00, 'image' => 'https://images.unsplash.com/photo-1622560480605-d83c853bc5c3?q=80&w=1000&auto=format&fit=crop'],
                    ['name' => 'Canvas Weekend Duffel', 'price' => 95.00, 'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1000&auto=format&fit=crop'],
                ]
            ],
            [
                'category' => 'Watches',
                'items' => [
                    ['name' => 'Classic Chronograph', 'price' => 350.00, 'image' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1000&auto=format&fit=crop'],
                    ['name' => 'Minimalist Gold Watch', 'price' => 120.00, 'image' => 'https://images.unsplash.com/photo-1523170335258-f5ed11844a49?q=80&w=1000&auto=format&fit=crop'],
                ]
            ],
        ];

        foreach ($products as $group) {
            $cat = Categorie::where('name', $group['category'])->first();
            if($cat) {
                foreach ($group['items'] as $item) {
                    Product::updateOrCreate(['name' => $item['name']], [
                        'category_id' => $cat->id,
                        'slug' => Str::slug($item['name']),
                        'price' => $item['price'],
                        'discount_price' => $item['price'] * 0.8, // 20% discount
                        'stock_quantity' => rand(10, 50),
                        'thumbnail' => $item['image'],
                        'status' => 1
                    ]);
                }
            }
        }
    }
}
