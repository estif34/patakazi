<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\User;
use App\Models\Category;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        $categories = Category::all();

        foreach ($categories as $category) {
            Job::factory()
                ->count(5)
                ->create([
                    'category_id' => $category->id,
                    'user_id' => $user->id,
                ]);
        }
    }
}
