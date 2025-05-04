<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizSession extends Model
{
    protected $table = 'quiz_sessions';
    public $timestamps = false;

    protected $fillable = [
        'quiz_id',
        'student_id',
        'quiz_id',
        'time_end'
    ];

    protected $casts = [
        'time_end' => 'datetime',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id', 'user_id');
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
