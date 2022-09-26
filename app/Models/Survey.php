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
     * Get the user who created the survey.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
