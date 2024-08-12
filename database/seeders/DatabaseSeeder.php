<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin')
        ]);

        $categories = [
            ['name' => 'Desktop'],
            ['name' => 'Laptop'],
            ['name' => 'Mobile']
        ];

        foreach ($categories as $row) 
        {
            Category::create($row);
        }

        $brands =[
            ['name' => 'HP'],
            ['name' => 'Dell'],
            ['name' => 'Samsung']
        ];
        
        foreach ($brands as $row)
        {
            Brand::create($row);
        }

        $products =[
            ['name' => 'HP laptop'],
            ['name' => 'Dell cpu'],
            ['name' => 'Samsung phone']
        ];
        
        foreach ($products as $row)
        {
            Product::create($row);
        }
    }
}
