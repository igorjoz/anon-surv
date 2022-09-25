<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    /**
     * Get the user who created the survey.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
