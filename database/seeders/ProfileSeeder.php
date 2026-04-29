<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::updateOrCreate(
            ['id' => 1],
            [
                'summary' => 'I am a Full Stack Developer with experience in Laravel, Angular, Ionic, and Python. I build simple, clean, and user-friendly web and mobile applications. I work on both frontend and backend, create APIs, and manage databases like MySQL and SQL Server. I have worked on HRMS, HIMS, and other real-time projects, and I also have experience using AWS, Docker, GitHub, and Postman. I enjoy learning new technologies and improving my skills. My goal is to create practical solutions that help users and make work easier.',
                'current_job_title' => 'Junior Software Developer',
                'current_job_company' => 'TH Systems Pvt. Ltd.',
                'current_job_start_date' => '2024-10-14',
                'image_path' => 'profile/profile.jpg',
                'resume_pdf_path' => 'resume/Ganesh_Mogal_Resume.pdf',
                'resume_doc_path' => 'resume/Ganesh_Mogal_Resume.docx',
            ]
        );
    }
}
