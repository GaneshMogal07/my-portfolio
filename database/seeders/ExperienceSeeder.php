<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;
use App\Models\Admin;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::where('email','admin@example.com')->first();
        $adminId = $admin?->id;

        $items = [
            [
                'title' => 'Junior Software Developer',
                'company' => 'TH Systems Pvt Ltd',
                'location' => 'Pune, Maharashtra',
                'start_date' => '2024-10-01',
                'end_date' => null,
                'description' => 'Developed HRMS and HIMS using Angular (web) and Ionic (mobile). Backend with Laravel and MySQL; handled SQL Server data ops; hands-on with AWS, Docker, GitHub.',
            ],
            [
                'title' => 'React Developer Intern',
                'company' => 'Woyce Technologies and Services Pvt Ltd',
                'location' => 'Pune, Maharashtra',
                'start_date' => '2024-06-01',
                'end_date' => '2024-09-30',
                'description' => 'Quick Reviews project focusing on UI design and API integration using Tailwind CSS and MUI. Improved API testing with Postman and managed large repos.',
            ],
            [
                'title' => 'Full Stack Intern',
                'company' => 'Sumago Infotech Pvt. Ltd.',
                'location' => 'Nashik, Maharashtra',
                'start_date' => '2023-01-01',
                'end_date' => '2023-02-28',
                'description' => 'Profile management application with PHP and Python. Frontend/backend dev, database operations, testing, and debugging.',
            ],
        ];

        foreach ($items as $e) {
            Experience::updateOrCreate(
                ['title' => $e['title'], 'company' => $e['company'], 'admin_id' => $adminId],
                $e + ['admin_id' => $adminId]
            );
        }
    }
}
