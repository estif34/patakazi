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

     private array $jobsByCategory = [
        'Software Development' => [
            'Senior Software Engineer',
            'Full Stack Developer',
            'PHP Developer',
            'JavaScript Developer',
            'Mobile App Developer',
            'React Developer',
            'Laravel Developer',
            'Software Architect'
        ],
        'Design' => [
            'UI/UX Designer',
            'Graphic Designer',
            'Product Designer',
            'Visual Designer',
            'Web Designer',
            'Brand Designer',
            'Interactive Designer'
        ],
        'Marketing' => [
            'Digital Marketing Manager',
            'Content Marketing Specialist',
            'SEO Specialist',
            'Social Media Manager',
            'Marketing Analytics Manager',
            'Email Marketing Specialist',
            'Growth Marketing Manager'
        ],
        'Sales' => [
            'Sales Representative',
            'Account Executive',
            'Sales Manager',
            'Business Development Manager',
            'Sales Operations Manager',
            'Enterprise Sales Executive'
        ],
        'Customer Service' => [
            'Customer Support Representative',
            'Customer Success Manager',
            'Technical Support Specialist',
            'Customer Experience Manager',
            'Support Team Lead'
        ],
        'Finance' => [
            'Financial Analyst',
            'Accountant',
            'Finance Manager',
            'Financial Controller',
            'Investment Analyst',
            'Risk Analyst'
        ],
        'Human Resources' => [
            'HR Manager',
            'Talent Acquisition Specialist',
            'HR Business Partner',
            'Recruitment Coordinator',
            'Employee Relations Manager',
            'Training Specialist'
        ],
        'Project Management' => [
            'Project Manager',
            'Scrum Master',
            'Program Manager',
            'Product Owner',
            'Delivery Manager',
            'Agile Coach'
        ],
        'Data Science' => [
            'Data Scientist',
            'Data Analyst',
            'Machine Learning Engineer',
            'BI Analyst',
            'Data Engineer',
            'Analytics Manager'
        ],
        'DevOps' => [
            'DevOps Engineer',
            'Site Reliability Engineer',
            'Cloud Engineer',
            'Infrastructure Engineer',
            'Systems Administrator',
            'Platform Engineer'
        ]
    ];

    private array $companies = [
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

    private array $locations = [
        'Nairobi, Kenya',
        'Mombasa, Kenya',
        'Kisumu, Kenya',
        'Remote',
        'Hybrid - Nairobi',
        'Nakuru, Kenya',
        'Eldoret, Kenya'
    ];

    private array $salaryRanges = [
        'KES 50,000 - 70,000',
        'KES 70,000 - 90,000',
        'KES 90,000 - 120,000',
        'KES 120,000 - 150,000',
        'KES 150,000 - 200,000',
        'Competitive',
        'KES 80,000 - 100,000'
    ];

    public function definition(): array
    {
        return [
            'description' => $this->faker->paragraphs(3, true),
            'company_name' => $this->faker->randomElement($this->companies),
            'location' => $this->faker->randomElement($this->locations),
            'salary_range' => $this->faker->randomElement($this->salaryRanges),
            'requirements' => $this->faker->paragraphs(2, true),
            'status' => $this->faker->randomElement(['active', 'inactive']), 
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
        ];
        
    }

    public function getJobTitlesForCategory(string $categoryName): array
    {
        return $this->jobsByCategory[$categoryName] ?? [];
    }
}
