<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'is_affirmative',
        'completed_survey_id',
        'question_id',
    ];

    public function completedSurvey()
    {
        return $this->belongsTo(CompletedSurvey::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
