<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'technologies',
        'image_path',
        'project_url',
        'created_date',
    ];

    protected $casts = [
        'created_date' => 'date',
    ];
}
