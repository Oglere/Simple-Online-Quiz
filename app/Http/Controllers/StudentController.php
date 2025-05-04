<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DocumentRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizSession;
use App\Models\QuizResult;

class StudentController extends Controller
{
    //

    public function dashboard() {
        $studentId = auth()->user()->user_id;
        $quizzes = Quiz::where('status', 'Ongoing')->get();
        $results = QuizResult::where('student_id', $studentId)->get()->keyBy('quiz_id');
        return view('student.dashboard', [
            'quizzes' => $quizzes,
            'results' => $results
        ]);
    }
    

    public function submission() {
        $teacher = User::where('role', 'Teacher')->get(); // Fetch all teachers
    
        return view('student.document-submission', ['teacher' => $teacher]);
    }

    public function status(){
        $auth = Auth::id();

        return view('student.document-status');
    }


    public function edit() {
        return view('student.edit');
    }

    public function submit(Request $request) {
        $request->validate([
            'title' => 'required|min:3',
            'abstract' => 'required',
            'co_authors' => 'nullable|string',
            'keywords' => 'nullable|string',
            'teacher_id' => 'required|exists:users,user_id',
            'publication_date' => 'nullable|date',
            'citations' => 'nullable|string',
            'file' => 'required|mimes:pdf|max:512000',
            'document_types' => 'required',
            'document_types.*' => 'string'
        ], [
            'title.required' => 'The title is required.',
            'title.min' => 'The title must be at least 3 characters.',
            'abstract.required' => 'The abstract is required.',
            'teacher_id.required' => 'Please select a teacher.',
            'teacher_id.exists' => 'The selected teacher does not exist.',
            'publication_date.date' => 'The publication date must be a valid date.',
            'file.required' => 'A PDF file is required.',
            'file.mimes' => 'The file must be a PDF.',
            'file.max' => 'The file size should not exceed 500MB.',
            'document_types.required' => 'Please select at least one document type.',
            'document_types.*.in' => 'Invalid document type selected.'
        ]);
    
        $coAuthors = $request->co_authors ? explode(',', $request->co_authors) : [];
        $keywords = $request->keywords ? explode(',', $request->keywords) : [];
        $citations = $request->citations ? explode(',', $request->citations) : [];
        $documentTypes = $request->document_types;
    
        $metadata = [
            'keywords' => $request->keywords,
            'abstract' => $request->abstract,
            'publication_date' => $request->publication_date,
        ];
    
        $fileData = file_get_contents($request->file('file')->getRealPath());
    
        $document = new DocumentRepository();
        $document->title = $request->title;
        $document->student_id = Auth::id();
        $document->teacher_id = $request->teacher_id;
        $document->authors = $coAuthors;
        $document->citations = $citations;
        $document->metadata = $metadata;
        $document->file = $fileData;
        $document->status = 'Pending';
        $document->date_submitted = now();
        $document->study_type = $documentTypes;
        $document->save(); // ✅ This saves the model
    
        return redirect()->back()->with('success', 'Document submitted successfully!');
    }
    

    public function pdf_reader($id) {
        $documentdata = DocumentRepository::findOrFail($id);
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            return abort(400, "Invalid document ID.");
        }

        $document = DocumentRepository::where('document_id', $id)
                            ->where('student_id', Auth::id())
                            ->first();

        if (!$document) {
            return DocumentRepository::where('document_id', $id)->exists()
                ? back()->with('error', 'Document not yours.')
                : abort(404, 'Document not found.');
        }

        $study_type = is_string($document->study_type)
            ? json_decode($document->study_type, true)
            : $document->study_type;

        $metadata = is_array($document->metadata) ? $document->metadata : json_decode($document->metadata, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $metadata = [];
        }

        return view('student.pdf-reader', [
            'pdf_data' => base64_encode($document->file),
            'abstract' => $metadata['abstract'] ?? '',
            'study_type' => $study_type,
            'publication_date' => $metadata['publication_date'] ?? '',
            'keywords' => $metadata['keywords'] ?? [],
            'document' => $document
        ]);
    }

    public function startQuiz(Request $request, $id){
        $studentId = auth()->user()->user_id;
        $quiz = Quiz::where('quiz_id', $id)->firstOrFail(); 
    
        $alreadyStarted = QuizSession::where('student_id', $studentId)
            ->where('quiz_id', $id)
            ->exists();
    
        if (!$alreadyStarted) {
            QuizSession::create([
                'student_id' => $studentId,
                'quiz_id' => $quiz->quiz_id,
                'time_end' => now()->addMinutes($quiz->duration)
            ]);
        }
    
        return redirect()->route('student.quiz.view', ['id' => $quiz->quiz_id]);
    }
    
    public function viewQuiz(Request $request, $id) {
        $student_id = auth()->user()->user_id;
        $quiz = Quiz::where('quiz_id', $id)->firstOrFail();
        $qna = QuizAnswer::where('quiz_id', $id)->get();
        $session = QuizSession::where('quiz_id', $id)
            ->where('student_id', $student_id)
            ->first();

        if (!$session) {
            abort(403, 'Unauthorized access to this quiz.');
        }

        if (now()->greaterThan($session->time_end)) {
            abort(403, 'Your quiz session has expired.');
        }

    
        return view('student.quiz', [
            'quiz' => $quiz,
            'qna' => $qna,
            'session' => $session
        ]);
    }

    public function submitQuiz(Request $request, $id) {
        $studentId = auth()->user()->user_id;
        $answers = $request->input('answers'); 
    
        $questions = QuizAnswer::where('quiz_id', $id)->get();
    
        $score = 0;
        $total = count($questions);
    
        foreach ($questions as $question) {
            if (isset($answers[$question->id]) && $answers[$question->id] === $question->answer) {
                $score++;
            }
        }
    
        $percentage = ($score / $total) * 100;
        $remarks = $percentage >= 75 ? 'Passed' : 'Failed';
    
        QuizResult::create([
            'student_id' => $studentId,
            'quiz_id' => $id,
            'score' => $score,
            'total_items' => $total,
            'percentage' => $percentage,
            'remarks' => $remarks,
            'answers' => json_encode($answers) // store as JSON
        ]);
    
        return redirect()->route('student.dashboard')->with('status', 'Quiz submitted successfully!');
    }
    
    public function results(Request $request, $id) {
        $studentId = auth()->user()->user_id;
    
        $quiz = Quiz::findOrFail($id);
        $result = QuizResult::where('quiz_id', $id)->where('student_id', $studentId)->firstOrFail();
        $questions = QuizAnswer::where('quiz_id', $id)->get();
    
        $studentAnswers = json_decode($result->answers, true);
    
        return view('student.results', [
            'quiz' => $quiz,
            'result' => $result,
            'studentAnswers' => $studentAnswers,
            'questions' => $questions
        ]);
    }
    
    
    
}
