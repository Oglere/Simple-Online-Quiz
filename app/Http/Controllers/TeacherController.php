<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;
use App\Models\QuizSession;
use App\Models\QuizAnswer;
use App\Models\User;
use Spatie\FlareClient\Http\Exceptions\NotFound;
use function PHPUnit\Framework\isEmpty;

class TeacherController extends Controller
{
    public function dashboard(){
        $id = Auth::id();
        $quizzes = Quiz::where('teacher', '=', $id)
            ->get();  // Add ->get() to fetch the results
        return view('teacher.dashboard', [
            'quizzes' => $quizzes,
            'id'=> $id
        ]);
    }

    public function review(){
        $teacher_id = Auth::id(); // Get currently logged-in teacher ID
        return view('teacher.review-studies', [
        ]);
    }

    public function edit(){
        return view('teacher.edit');
    }

    public function quizadd(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'duration' => 'required|integer|min:1', // Validate duration as positive integer
        ]);

        // Create a new quiz record in the database
        $quiz = Quiz::create([
            'teacher' => auth()->id(), // assuming the teacher is logged in
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'duration' => $request->input('duration'),
            'status' => "Draft",
        ]);

        // Redirect back or to another page with a success message
        return redirect()->back()->with('success', 'Quiz added successfully!');
    }

    public function quiz(Request $request, $id) {
        $quiz = Quiz::findOrFail($id);

        if($quiz->teacher != Auth::id()) {
            return redirect()->back();
        }

        $questions = QuizAnswer::where('quiz_id', '=', $id)->get(); // pass $quizId from route
        return view('teacher.quizStation', [
            'quiz' => $quiz,
            'questions' => $questions
        ]);
    }

    public function question(Request $request, $id){
        // Validate input
        $validated = $request->validate([
            'question'   => 'required|string',
            'option_a'   => 'required|string',
            'option_b'   => 'required|string',
            'option_c'   => 'required|string',
            'option_d'   => 'required|string',
            'answer'     => 'required|in:option_a,option_b,option_c,option_d',
        ]);

        $created = QuizAnswer::create([
            'quiz_id'   => $id,
            'question'  => $validated['question'],
            'option_a'  => $validated['option_a'],
            'option_b'  => $validated['option_b'],
            'option_c'  => $validated['option_c'],
            'option_d'  => $validated['option_d'],
            'answer'    => $validated['answer'],
        ]);

        return redirect()->back()->with('message', 'Question added successfully!');
    }

    public function getquestion($id){
        $question = QuizAnswer::find($id);

        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        return response()->json($question);
    }

    public function getquiz($id){
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json(['error' => 'Quiz not found'], 404);
        }

        return response()->json($quiz);
    }

    public function upq(Request $request, $id){
        $validated = $request->validate([
            'question'   => 'required|string',
            'option_a'   => 'required|string',
            'option_b'   => 'required|string',
            'option_c'   => 'required|string',
            'option_d'   => 'required|string',
            'answer'     => 'required|in:option_a,option_b,option_c,option_d',
        ]);

        $question = QuizAnswer::find($id);

        if (!$question) {
            return redirect()->back()->with('error', 'Question not found!');
        }

        $question->update([
            'question'  => $validated['question'],
            'option_a'  => $validated['option_a'],
            'option_b'  => $validated['option_b'],
            'option_c'  => $validated['option_c'],
            'option_d'  => $validated['option_d'],
            'answer'    => $validated['answer'],
        ]);

        return redirect()->back()->with([
            'edit' => 'Question updated successfully!',
            'edited_id' => $id
        ]);
    }

    public function deleteQuestion($id) {
        QuizAnswer::findOrFail($id)->delete();

        return redirect()->back()->with([
            'deleted' => 'Question deleted successfully!',
            'deleted_id' => $id
        ]);
    }
    
    public function deploy( $id) {
        $quiz = Quiz::findOrFail($id);
        $quiz->status = 'Ongoing';
        $quiz->save();

        return redirect()->back()->with([
            'deployed' => 'Quiz deployed successfully!',
            'deployed_id' => $id
        ]);
    }
    
    public function revert( $id) {
        $quiz = Quiz::findOrFail($id);
        $quiz->status = 'Draft';
        $quiz->save();

        return redirect()->back()->with([
            'deployed' => 'Quiz revert successfully!',
            'deployed_id' => $id
        ]);
    }

    public function updatequiz(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
        ]);
    
        $quiz = Quiz::findOrFail($id);
    
        $quiz->title = $request->input('title');
        $quiz->description = $request->input('description');
        $quiz->duration = $request->input('duration');
        $quiz->save();
    
        return redirect()->back()->with('message', 'Quiz updated successfully!');
    }

    public function deletequiz($id) {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
    
        return redirect()->back()->with('success', 'Quiz deleted successfully!');
    }
    
}
