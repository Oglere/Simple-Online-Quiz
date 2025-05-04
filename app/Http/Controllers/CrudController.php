<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CrudController extends Controller
{
    public function lagin(Request $request) {
        $incomingFields = $request->validate([
            'usn_login' => ['required', 'min:3'],
            'password_hash_login' => ['required']
        ]);
    
        $user = User::where('usn', $incomingFields['usn_login'])
                    ->where('status', 'Active')
                    ->first();
    
        if ($user && Hash::check($incomingFields['password_hash_login'], $user->password_hash)) {
            Auth::login($user);
            $request->session()->regenerate();
    
            // Role-based redirection
            return match ($user->role) {
                'Admin' => redirect('/admin'),
                'Teacher' => redirect('/teacher'),
                'Student' => redirect('/student'),
            };
        }
    
        return back()->withErrors(['Invalid credentials or inactive account.']);
    }

    public function create(Request $request) {
        $incomingFeilds = $request->validate([   
            'last_name' => ['required','min:3'], 
            'first_name' => ['required','min:3'],
            'usn' => ['required','min:3', Rule::unique('users', 'usn')],
            'password_hash' => 'required',
            'email' => ['required', Rule::unique('users', 'usn')],
            'role' => 'required',
            'status' => 'required',
        ]);

        $user = User::create([
            'last_name' => $request->last_name, 
            'first_name' => $request->first_name,
            'usn' => $request->usn,
            'password_hash' => Hash::make($request->password_hash),
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        auth()->login($user);

        return redirect('/lists');
    }

    public function out() {
        auth()->logout();
        return redirect('/lists');
    }
}
