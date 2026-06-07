<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificate;
use App\Models\Admin;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::where('email','admin@example.com')->first();
        $adminId = $admin?->id;

        $certs = [
             [
                'title' => 'AWS Certified Cloud Practitioner',
                'level' => 'AWS Certified',
                'file_path' => 'certificates/AWS.png',
                'issue_date' => '2025-12-12',
                'expires_at' => '2028-12-12',
            ],
            [
                'title' => 'C and C++',
                'level' => 'Course',
                'file_path' => 'certificates/hC9j46aV5uQzABlXla3gqFCPsTu4tPNMnDzV96d9.jpg',
                'issue_date' => '2022-03-01',
                'expires_at' => null,
            ],
            [
                'title' => 'HTML, CSS, JavaScript, React',
                'level' => 'Course',
                'file_path' => 'certificates/web-react.png',
                'issue_date' => '2023-03-01',
                'expires_at' => null,
            ],
            [
                'title' => 'TCS ION Career Edge - Young Professional',
                'level' => 'Certification',
                'file_path' => 'certificates/tcs-ion.png',
                'issue_date' => '2023-01-01',
                'expires_at' => null,
            ],
            [
                'title' => 'Database, SQL Server, T-SQL',
                'level' => 'Course',
                'file_path' => 'certificates/sql-server.png',
                'issue_date' => '2025-01-01',
                'expires_at' => null,
            ],
            [
                'title' => 'Prompt Design in Vertex AI Skill Badge',
                'level' => 'Skill Badge',
                'file_path' => 'certificates/vertex-ai.png',
                'issue_date' => '2025-01-01',
                'expires_at' => null,
            ],
            [
                'title' => 'Ionic – Build iOS, Android & Web Apps',
                'level' => 'Course',
                'file_path' => 'certificates/ionic.png',
                'issue_date' => '2025-01-01',
                'expires_at' => null,
            ],
        ];

        foreach ($certs as $c) {
            Certificate::updateOrCreate(
                ['title' => $c['title'], 'admin_id' => $adminId],
                $c + ['admin_id' => $adminId]
            );
        }
    }
}
