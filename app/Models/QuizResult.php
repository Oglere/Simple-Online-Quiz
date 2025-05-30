<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'quiz_id', 'score', 'total_items', 'percentage', 'remarks', 'answers',
    ];
}
