<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $feedbacks = [
            [
                'employee_name' => 'John Doe',
                'company' => 'TH Systems Pvt. Ltd.',
                'feedback' => 'Ganesh is a very dedicated developer. His work on the HRMS was exceptional.',
                'rating' => 5,
                'is_featured' => true,
            ],
            [
                'employee_name' => 'Jane Smith',
                'company' => 'Woyce Technologies',
                'feedback' => 'Great at UI design and API integration. A pleasure to work with.',
                'rating' => 5,
                'is_featured' => true,
            ],
            [
                'employee_name' => 'Michael Ross',
                'company' => 'Sumago Infotech',
                'feedback' => 'Quick learner and very efficient in backend development.',
                'rating' => 4,
                'is_featured' => true,
            ],
            [
                'employee_name' => 'Sarah Connor',
                'company' => 'TH Systems Pvt. Ltd.',
                'feedback' => 'Always delivers on time and with high quality code.',
                'rating' => 5,
                'is_featured' => true,
            ],
            [
                'employee_name' => 'Robert Paulson',
                'company' => 'Freelance Client',
                'feedback' => 'Excellent communication and technical skills.',
                'rating' => 5,
                'is_featured' => true,
            ],
        ];

        foreach ($feedbacks as $f) {
            \App\Models\Feedback::create($f);
        }
    }
}
