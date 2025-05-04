<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';
    protected $fillable = [
        'last_name',
        'first_name',
        'password_hash',
        'email',
        'role',
        'last_login',
        'status'
    ];

    protected $hidden = [
        'password_hash',
        'remember_token'
    ];

    public function submittedDocuments(){
        return $this->hasMany(QuizAnswer::class, 'student_id');
    }

    public function reviewedDocuments(){
        return $this->hasMany(Quiz::class, 'teacher_id');
    }

}
