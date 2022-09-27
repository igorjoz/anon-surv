<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Survey extends Model
{
    use HasFactory, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'url_slug',
        'description',
        'is_published',
        'user_id',
    ];

    public $sortable = [
        'id',
        'title',
        'description',
        'is_published',
        'created_at',
    ];

    /**
     * Get the User who created the Survey.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Questions belonging to the Survey.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Get the CompletedSurveys belonging to the Survey.
     */
    public function completedSurveys()
    {
        return $this->hasMany(CompletedSurvey::class);
    }
}
