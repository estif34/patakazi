<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\User;
use App\Models\Job;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    protected $model = Job::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jobTitles = [
            'Senior Software Engineer',
            'Product Manager',
            'UX Designer',
            'Data Scientist',
            'Marketing Manager',
            'Sales Representative',
            'Frontend Developer',
            'Backend Developer',
            'DevOps Engineer',
            'HR Manager',
            'Content Writer',
            'Financial Analyst',
            'Project Manager',
            'Business Analyst',
            'Customer Success Manager'
        ];

        $companies = [
            'TechCorp Solutions',
            'Innovation Labs',
            'Digital Dynamics',
            'Future Systems',
            'Cloud Nine Tech',
            'Data Driven Inc.',
            'Smart Solutions Ltd.',
            'Global Tech Partners',
            'Next Level Digital',
            'Progressive Systems'
        ];

        $locations = [
            'Cairo, Egypt',
            'Nairobi, Kenya',
            'Lagos, Nigeria',
            'Cape Town, South Africa',
            'Accra, Ghana',
            'Addis Ababa, Ethiopia',
            'Dakar, Senegal',
            'Kigali, Rwanda',
            'Tunis, Tunisia',
            'Kinshasa, Democratic Republic of Congo'
        ];
        

        $salaryRanges = [
            '$50,000 - $70,000',
            '$70,000 - $90,000',
            '$90,000 - $120,000',
            '$120,000 - $150,000',
            '$150,000 - $200,000',
            'Competitive',
            '$80,000 - $100,000',
            '$100,000 - $130,000',
            '$130,000 - $160,000',
            '$160,000 - $180,000'
        ];

        return [
            'title' => $this->faker->randomElement($jobTitles),
            'description' => $this->faker->paragraphs(3, true),
            'company_name' => $this->faker->randomElement($companies),
            'location' => $this->faker->randomElement($locations),
            'salary_range' => $this->faker->randomElement($salaryRanges),
            'requirements' => $this->faker->paragraphs(2, true),
            'status' => $this->faker->randomElement(['active', 'inactive']),
                // 'category_id' => Category::factory(),
                // 'user_id' => User::factory(),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
        ];
        
    }
}
