<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'summary',
        'image_path',
        'resume_pdf_path',
        'resume_doc_path',
        'current_job_title',
        'current_job_company',
        'current_job_start_date',
    ];
}
