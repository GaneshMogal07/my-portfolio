<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Buying Selling Auction Platform',
                'description' => 'A platform where you can sell, lend, share or give out a commodity for auction. Developed with real-time bidding and secure transactions.',
                'technologies' => 'HTML,CSS,JavaScript,MySQL,PHP',
                'project_url' => 'https://github.com/ganumogal/BUYING-SELLING-AUCTION-PLATFORM.git',
                'created_date' => '2021-01-01',
            ],
            [
                'title' => 'Portfolio',
                'description' => 'A professional portfolio website designed to showcase my work with a focus on consistency and professionalism, featuring a polished, user-friendly interface.',
                'technologies' => 'HTML,CSS,JavaScript,MySQL,jQuery,Bootstrap',
                'project_url' => 'https://github.com/ganumogal/PORTFOLIO',
                'created_date' => '2023-01-01',
            ],
            [
                'title' => 'Depression Detection Using BERT Algorithm',
                'description' => 'A depression detection system leveraging BERT algorithm to analyze social media posts and identify signs of depression, with a web interface for analysis results.',
                'technologies' => 'Python,Transformers,TensorFlow,PyTorch,Flask',
                'project_url' => null,
                'created_date' => '2024-01-01',
            ],
        ];
        foreach ($projects as $p) {
            Project::updateOrCreate(['title' => $p['title']], $p);
        }
    }
}
