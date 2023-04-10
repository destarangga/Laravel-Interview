<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
    protected $fillable = [
        'interview_id',
        'status',
        'schedule',
    ];

    public function interview()
    {
        return $this->belongTox
        (Interview::class);
    }
}

