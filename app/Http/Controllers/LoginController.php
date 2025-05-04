<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{     
    public function login(Request $request) {
        $incomingFields = $request->validate([
            'usn_login' => 'required',
            'password_hash_login' => 'required'
        ]);
    
        $user = User::where('email', $incomingFields['usn_login'])->where('status', 'Active')->first();
    
        if ($user && Hash::check($incomingFields['password_hash_login'], $user->password_hash)) {
            Auth::login($user);
            $request->session()->regenerate();
    
            // Role-based redirection
            return match ($user->role) {
                'Admin' => redirect('admin'),
                'Teacher' => redirect('teacher'),
                'Student' => redirect('student'),
                default => back()->withErrors(['Error' => 'Invalid role'])
            };
            
        } else {
            return back()->withErrors(['Error' => 'Error']);
        }
    
    }

    public function register(Request $request) {
        return view('go.register');
    
    }


    
    public function recovery() {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('go.recovery');
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $user->update(['last_login' => now()]);
        }
        auth::logout();
        Session::flush();
        Redirect::back();
        return redirect::to('/');
    }

    public function createaccount(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
            'status' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();
        $data['password_hash'] = Hash::make($data['password']);
        unset($data['password']); // optional: remove the plain password

        User::create($data);
    
        return redirect('/')->with('success', 'You can login!');
    }
}
