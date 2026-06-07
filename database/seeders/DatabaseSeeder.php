<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Database\Seeders\ProfileSeeder;
use Database\Seeders\SkillSeeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\CertificateSeeder;
use Database\Seeders\ExperienceSeeder;
use Database\Seeders\EducationSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Admin@123'),
            ]
        );

        $this->call([
            ProfileSeeder::class,
            SkillSeeder::class,
            ProjectSeeder::class,
            CertificateSeeder::class,
            ExperienceSeeder::class,
            EducationSeeder::class,
        ]);
    }
}
