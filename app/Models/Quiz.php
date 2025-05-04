<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quiz extends Model
{
    protected $table = 'quiz';
    protected $primaryKey = 'quiz_id';
    public $timestamps = false;

    protected $fillable = [
        'teacher',
        'title',
        'description',
        'duration',
        'status'
    ];

    protected $casts = [
        'teacher' => 'integer',
        'duration' => 'integer',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher', 'user_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(QuizAnswer::class, 'quiz_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(QuizSession::class, 'quiz_id');
    }
}
