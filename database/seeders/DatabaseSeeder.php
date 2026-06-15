<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Instrumenti']);
        Category::create(['name' => 'Elektronika']);
        Category::create(['name' => 'Sports']);
        Category::create(['name' => 'Mājsaimniecība']);
        Category::create(['name' => 'Grāmatas']);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => 'admin',
            'is_blocked' => false,
        ]);

        User::create([
            'name' => 'Lietotājs',
            'email' => 'user@example.com',
            'password' => 'password',
            'role' => 'user',
            'is_blocked' => false,
        ]);
    }
}