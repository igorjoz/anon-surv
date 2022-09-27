<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'is_open_question',
        'is_yes-no_question',
        'survey_id',
        'order',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
