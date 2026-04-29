<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Education;
use App\Models\Admin;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::where('email','admin@example.com')->first();
        $adminId = $admin?->id;

        $items = [
            [
                'institution' => 'AMRUTVAHINI COLLEGE OF ENGINEERING, SANGMNER',
                'degree' => 'B.E. Computer Engineering',
                'details' => 'Relevant Coursework: Data Structures, Software Engineering, DBMS, Networks, TOC, OOP, Image & Video Processing',
                'grade' => 'CGPA: 7.46',
                'start_date' => '2021-01-01',
                'end_date' => '2024-12-31',
            ],
            [
                'institution' => 'DR. VITTHALRAO VIKHE PATIL INSTITUTE OF TECHNOLOGY & ENGINEERING (POLYTECHNIC) LONI',
                'degree' => 'Diploma – Computer Engineering',
                'details' => 'Relevant Coursework: Data Structures, Software Engineering',
                'grade' => 'Percentage: 92.74%',
                'start_date' => '2019-01-01',
                'end_date' => '2021-12-31',
            ],
            [
                'institution' => 'SHREE GANESH JUNIOR COLLEGE KORHALE',
                'degree' => 'HSC',
                'details' => null,
                'grade' => 'Percentage: 60%',
                'start_date' => '2017-01-01',
                'end_date' => '2019-12-31',
            ],
            [
                'institution' => 'NEW ENGLISH SCHOOL KANKURI',
                'degree' => 'SSC',
                'details' => null,
                'grade' => 'Percentage: 71.60%',
                'start_date' => '2016-01-01',
                'end_date' => '2017-12-31',
            ],
        ];

        foreach ($items as $e) {
            Education::updateOrCreate(
                ['institution' => $e['institution'], 'degree' => $e['degree'], 'admin_id' => $adminId],
                $e + ['admin_id' => $adminId]
            );
        }
    }
}
