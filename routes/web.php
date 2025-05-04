<?php
use App\Http\Controllers\Controller;
use App\Http\Controllers\OtpController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCrudController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\TeacherController;

Route::get('/test', function () {
    return view('test');
});

Route::get('/', [QueryController::class, 'index']);
Route::get('/register', [LoginController::class, 'register']);

Route::post('/create', [LoginController::class, 'createaccount']);
Route::post('/go/login', [LoginController::class, 'login']);

Route::get('/go/recovery', [LoginController::class, 'recovery'])->name('recovery');

Route::post('/out', [LoginController::class, 'logout']);

Route::middleware(['ensure.recovery', 'prevent-back-history'])->group(function () {
    Route::get('/go/recovery/verify', [OTPController::class, 'recovery']);
    
    Route::post('/go/recovery/email', [OtpController::class, 'verify']);
    Route::post('/go/recovery/verify/otp', [OtpController::class, 'otp']);
    Route::post('/go/recovery/{email}/login', [OtpController::class, 'login']);
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard']);
    Route::get('/user-control', [AdminController::class, 'userControl']);
    Route::get('/edit', [AdminController::class, 'edit']);
    Route::get('/recovery', [AdminController::class, 'recovery']);

    Route::post('/create', [AdminCrudController::class, 'create']);
    Route::post('/edit/{id}', [AdminCrudController::class, 'edit']);
    Route::post('/delete/{id}', [AdminCrudController::class, 'delete']);
    Route::post('/recovery/{id}', [AdminCrudController::class, 'recover']);
    Route::post('/done/{id}', [AdminCrudController::class, 'markAsDone']);
    Route::post('/editacc/{id}', [AdminCrudController::class, 'editacc']);
    Route::post('/update-acc/{id}', [AdminCrudController::class, 'updateacc']);

    Route::post('/storage/{id}/1', [AdminCrudController::class, 'one']);
    Route::post('/storage/{id}/2', [AdminCrudController::class, 'two']);
    Route::post('/storage/{id}/3', [AdminCrudController::class, 'three']);
});

Route::prefix('student')->middleware(['auth', 'student'])->group(function () {
    Route::get('/', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/history', [StudentController::class, 'status']);
    Route::get('/edit', [StudentController::class, 'edit']);
    Route::get('/result/{id}', [StudentController::class, 'results']);
    Route::get('/quiz/{id}', [StudentController::class, 'viewQuiz'])->name('student.quiz.view');

    Route::post('/quiz/submitanswers/{id}', [StudentController::class, 'submitQuiz']);
    Route::post('/start-quiz/{id}', [StudentController::class, 'startQuiz'])->name('student.start.quiz');
    Route::post('/editacc/{id}', [AdminCrudController::class, 'editacc']);
    Route::post('/update-acc/{id}', [AdminCrudController::class, 'updateacc']);
});

Route::prefix('teacher')->middleware(['auth', 'teacher'])->group(function () {
    Route::get('/', [TeacherController::class, 'dashboard']);
    Route::get('/review-quizzes', [TeacherController::class, 'review']);
    Route::get('/edit', [TeacherController::class, 'edit']);
    Route::get('/quiz/{id}', [TeacherController::class, 'quiz']);
    Route::get('/getquestion/{id}', [TeacherController::class, 'getquestion']);
    Route::get('/getquiz/{id}', [TeacherController::class, 'getquiz']);

    Route::post('/addquiz', [TeacherController::class, 'quizadd']);
    Route::post('/quiz/addquestion/{id}', [TeacherController::class, 'question']);
    Route::post('/updatequestion/{id}', [TeacherController::class, 'upq']);
    Route::post('/quiz/deletequestion/{id}', [TeacherController::class, 'deleteQuestion']);
    Route::post('/deployquiz/{id}', [TeacherController::class, 'deploy']);
    Route::post('/revertquiz/{id}', [TeacherController::class, 'revert']);
    Route::post('/updatequiz/{id}', [TeacherController::class, 'updatequiz']);
    Route::post('/deletequiz/{id}', [TeacherController::class, 'deletequiz']);
    Route::post('/editacc/{id}', [AdminCrudController::class, 'editacc']);
    Route::post('/update-acc/{id}', [AdminCrudController::class, 'updateacc']);
});
