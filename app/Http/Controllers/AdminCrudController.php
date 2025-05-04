<?php

namespace App\Http\Controllers;

use App\Models\DocumentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AdminCrudController extends Controller
{

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password_hash' => ['nullable', 'min:8'],
            'role' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'createErrors')
                ->withInput();
        }

        $data = $validator->validated();
        $data['password_hash'] = $request->filled('password_hash')
            ? Hash::make($data['password_hash'])
            : Hash::make('defaultpassword');

        User::create($data);

        return redirect('/admin/user-control')->with('success', 'User created successfully!');
    }

    public function edit(Request $request, $id) {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'. $id . ',user_id',
            'password_hash' => ['nullable', 'min:8'],
            'role' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'editErrors')
                ->withInput()
                ->with('editUserId', $id);
        }
        
        $data = $validator->validated();
        $user->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'status' => $data['status'],
            'password' => $request->filled('password_hash')
                ? Hash::make($data['password_hash'])
                : $user->password,
        ]);

        return redirect()->back()->with('success', 'User updated successfully!');
    }
    
    public function delete(Request $request, $id){
        $user = User::findOrFail($id);
        $user->update(['status' => 'Deleted']);
    
        return redirect()->back()->with('success', 'User updated successfully!');
    }   

    public function recover(Request $request, $id){
        $user = User::findOrFail($id);
        $user->update(['status' => 'Active']);
    
        return redirect()->back()->with('success', 'User updated successfully!');
    }   

    public function editacc(Request $request, $id){
        $user = User::findOrFail($id);

        $request->validate([
            'password_hash' => 'required'
        ]);

        if (!Hash::check($request->password_hash, $user->password_hash)) {
            return back()->withErrors(['Invalid credentials or inactive account.']);
        }

        $editFormHtml = view('admin.show', compact('user'))->render();

        return back()->with('editForm', $editFormHtml);
    } 
    

    public function updateacc(Request $request, $id) {
        $user = User::findOrFail($id);
    
        $updateUser = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($id, 'user_id'), // Specify the correct primary key column
            ],
            'password_hash' => ['nullable', 'min:8'],
        ]);
    
        if ($request->filled('password_hash')) {
            $updateUser['password_hash'] = Hash::make($request->password_hash);
        } else {
            unset($updateUser['password_hash']); 
        }
    
        $user->update($updateUser);
    
        return redirect()->back()->with('success', 'Account updated successfully!');
    }

    public function three($id) {
        DocumentRepository::where('document_id', '=', $id)->update(['status' => '0']);
        return back()->with('success', 'Document permanently deleted.');
    }

    public function two($id) {
        DocumentRepository::where('document_id', '=', $id)->update(['status' => 'Pending']);
        return back()->with('success', 'Document recovered.');
    }

    public function one($id) {
        DocumentRepository::where('document_id', '=', $id)->update(['status' => 'LostDoc']);
        return back()->with('success', 'Document moved to LostDoc.');
    }
}

