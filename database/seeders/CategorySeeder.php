<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['T-Shirt', 'Jacket', 'Shirt', 'Jeans', 'Bag', 'Shoes', 'Watches', 'Cap'];

        foreach ($categories as $cat) {
            Categorie::updateOrCreate(['name' => $cat], [
                'slug' => Str::slug($cat),
                'status' => 'active'
            ]);
        }
    }
}
