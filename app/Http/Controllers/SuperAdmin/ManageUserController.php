<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ManageUserController extends Controller
{
    // Display a listing of users
    public function index() {
        $users = User::paginate(10);
        return view('superadmin.manage-users.index', compact('users'));
    }

    // Show the form for creating a new user
    public function create() {
        return view('superadmin.manage-users.create');
    }

    // Show the form for editing the specified user
    public function edit(User $user) {
        return view('superadmin.manage-users.edit', compact('user'));
    }

    // Store a newly created user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|lowercase|unique:users',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'password' => 'required|confirmed|min:8',
            'usertype' => 'required|in:user,admin,superadmin',
        ]);

        // Create the user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'usertype' => $request->usertype,
        ]);

        return redirect()->route('superadmin.manage-users.index')->with('success', 'Akun berhasil ditambahkan');
    }

    // Update the specified user
    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'usertype' => 'required|in:user,admin,superadmin',
            'password' => 'nullable|string|min:8',
        ]);
    
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'usertype' => $request->usertype,  // Update the role (usertype)
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);
    
        return redirect()->route('superadmin.manage-users.index')->with('success', 'User updated successfully.');
    }

    // Remove the specified user
    public function destroy($name)
    {
        $user = User::where('name', $name)->firstOrFail();
        $user->delete();

        return redirect()->route('superadmin.manage-users.index')->with('success', 'User deleted successfully.');
    }
}
