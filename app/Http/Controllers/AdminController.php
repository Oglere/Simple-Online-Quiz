<?php

namespace App\Http\Controllers;

use App\Models\DocumentRepository;
use App\Models\Notification_logs;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{ 
    public function dashboard()
    {
        $totalUsers = User::count();

        $totalMsgs = User::where('status', '=', 'Deleted')->count();

        $recentUsersOnline = User::whereNotNull('last_login')
            ->orderBy('last_login', 'desc')
            ->take(5)
            ->get();
            
        return view("admin.dashboard", compact(
            'totalUsers', 'totalMsgs', 'recentUsersOnline',
        ));
    }

    private function formatSizeUnits($bytes) {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' bytes';
        } else {
            return '0 bytes';
        }
    }

    public function userControl() {

        $adminId = Auth::id();
        $org = User::where('user_id', '!=', $adminId)
                    ->where('status', '!=', 'Deleted')
                    ->get();

        $roles = User::select('role')->distinct()->pluck('role');
        $statuses = User::select('status')->distinct()->pluck('status');

        return view("admin.user-control", [
            "org"=> $org, 
            "roles" => $roles, 
            "statuses" => $statuses,
        ]);
    }

    public function edit() {

        return view("admin.edit", [
        ]);
    }
    
    public function messages() {
        $documents = DocumentRepository::query()
            ->where('status', '!=', '0')
            ->get();
        
        foreach ($documents as $doc) {
            $doc->formatted_size = $this->formatSizeUnits(strlen($doc->file)); // or use OCTET_LENGTH if file is in DB
        }
        return view('admin.messages', ['docu' => $documents]);
    }

    

    public function markAsDone(Request $request){
        $notificationId = $request->input('notification_id');
        DB::table('account_requests')->where('notification_id', $notificationId)->delete(); // Mark as done by deleting

        return redirect()->route('account.requests')->with('success', 'Request marked as done.');
    }

    public function recovery() {

        $org = User::where('status', '=', 'Deleted')
                    ->get();

        $roles = User::select('role')->distinct()->pluck('role');
        $statuses = User::select('status')->distinct()->pluck('status');

        return view("admin.recovery", [
            "org"=> $org, 
            "roles" => $roles, 
            "statuses" => $statuses,
        ]);

    }

    public function pdf($id) {
        $document = DocumentRepository::findOrFail($id);

        $metadata = is_array($document->metadata) ? $document->metadata : json_decode($document->metadata, true);
        $category = is_string($document->study_type)
            ? json_decode($document->study_type, true)
            : $document->study_type;

        return view('admin.pdf-reader', [
            'title' => $document->title,
            'abstract' => $metadata['abstract'],
            'publication_date' => $metadata['publication_date'] ?? 'No Date',
            'keywords' => $metadata['keywords'] ?? [],
            'studytype' => $category,
            'pdf_data' => $document->file,  
        ]);
    }
}
