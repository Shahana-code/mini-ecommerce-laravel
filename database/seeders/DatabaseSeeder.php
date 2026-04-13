<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Customer
        User::create([
            'name' => 'Test Customer',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // Demo Products
        Product::create([
            'name' => 'Awesome Sneakers',
            'price' => 79.99,
            'description' => 'Really comfortable and stylish sneakers. Great for walking or casual wear.',
            'stock' => 50,
        ]);
        
        Product::create([
            'name' => 'Wireless Headphones',
            'price' => 149.50,
            'description' => 'Noise-cancelling wireless headphones with long battery life.',
            'stock' => 15,
        ]);
        
        Product::create([
            'name' => 'Coffee Mug',
            'price' => 12.00,
            'description' => 'Ceramic coffee mug that says "World\'s Best Developer".',
            'stock' => 100,
        ]);
    }
}
