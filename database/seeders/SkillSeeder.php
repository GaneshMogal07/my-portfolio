<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            ['name' => 'HTML', 'category' => 'Frontend', 'level' => ''],
            ['name' => 'CSS', 'category' => 'Frontend', 'level' => ''],
            ['name' => 'Tailwind CSS', 'category' => 'Frontend', 'level' => ''],
            ['name' => 'JavaScript', 'category' => 'Frontend', 'level' => ''],
            ['name' => 'Angular', 'category' => 'Frontend', 'level' => ''],
            ['name' => 'Ionic', 'category' => 'Frontend', 'level' => ''],
            ['name' => 'ReactJS', 'category' => 'Frontend', 'level' => ''],
            ['name' => 'Bootstrap', 'category' => 'Frontend', 'level' => ''],
            ['name' => 'Material UI', 'category' => 'Frontend', 'level' => ''],

            ['name' => 'Laravel PHP', 'category' => 'Backend & Programming', 'level' => ''],
            ['name' => 'Python', 'category' => 'Backend & Programming', 'level' => ''],
            ['name' => 'C', 'category' => 'Backend & Programming', 'level' => ''],
            ['name' => 'C++', 'category' => 'Backend & Programming', 'level' => ''],
            ['name' => 'MySQL', 'category' => 'Backend & Programming', 'level' => ''],
            ['name' => 'SQL Server', 'category' => 'Backend & Programming', 'level' => ''],
            ['name' => 'Scikit-learn', 'category' => 'Backend & Programming', 'level' => ''],
            ['name' => 'Pandas', 'category' => 'Backend & Programming', 'level' => ''],
            ['name' => 'NumPy', 'category' => 'Backend & Programming', 'level' => ''],
            ['name' => 'TensorFlow', 'category' => 'Backend & Programming', 'level' => ''],
            ['name' => 'PyTorch', 'category' => 'Backend & Programming', 'level' => ''],

            ['name' => 'Git & GitHub', 'category' => 'Tools & Others', 'level' => ''],
            ['name' => 'Postman', 'category' => 'Tools & Others', 'level' => ''],
            ['name' => 'Playground', 'category' => 'Tools & Others', 'level' => ''],
            ['name' => 'API Integration', 'category' => 'Tools & Others', 'level' => ''],
            ['name' => 'VPN Extension', 'category' => 'Tools & Others', 'level' => ''],
            ['name' => 'Docker', 'category' => 'Tools & Others', 'level' => ''],
            ['name' => 'AWS', 'category' => 'Tools & Others', 'level' => ''],
        ];

        foreach ($skills as $s) {
            Skill::updateOrCreate(['name' => $s['name'], 'category' => $s['category']], ['level' => $s['level']]);
        }
    }
}
