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

        $factory = Job::factory();

        $categories = Category::all();

        // Create jobs for each category
        foreach ($categories as $category) {
            // Get job titles specific to this category
            $jobTitles = $factory->getJobTitlesForCategory($category->name);

            // Create 3-5 jobs for each category
            $numberOfJobs = rand(3, 5);
            
            // Randomly select job titles without repetition
            $selectedTitles = collect($jobTitles)
                ->random(min(count($jobTitles), $numberOfJobs))
                ->all();

            foreach ($selectedTitles as $title) {
                Job::factory()->create([
                    'title' => $title,
                    'category_id' => $category->id,
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
