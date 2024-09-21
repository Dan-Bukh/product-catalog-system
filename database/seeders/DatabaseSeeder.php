<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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
        User::create([
            'name' => 'test',
            'role' => 'admin', // admin
            'email' => 'test@example.com',
            'password' => Hash::make('123'),
        ]);

        User::create([
            'name' => 'test2',
            'role' => 'user', // user
            'email' => 'test2@example.com',
            'password' => Hash::make('123'),
        ]);

        Category::factory(10)->create()->each(function ($category) {
            Product::factory(rand(1, 5))->create(['category_id' => $category->id]);
        });
    }
}
