<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    protected $fillable = [
        'title',
        'level',
        'description',
        'file_path',
        'issue_date',
        'expires_at',
        'admin_id',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expires_at' => 'date',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
