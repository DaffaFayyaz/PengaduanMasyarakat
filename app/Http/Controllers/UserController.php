<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $role=Auth()->user()->role;

            if($role =='admin')
            {
                $users = User::all();
                return view('admin.daftarAkun', compact('users'));
            } else {
                return redirect()->route('home');
            }
        }
    }

    public function create()
    {
        if(Auth::id())
        {
            $role=Auth()->user()->role;

            if($role =='admin')
            {
                $users = User::all();
                return view('admin.adminTambahPetugas', compact('users'));
            } else {
                return redirect()->route('home');
            }
        }
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|string',
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        
        return redirect()->route('daftar.user');
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, 
            'password' => 'nullable|min:8', 
            'role' => 'required|string',
        ]);

        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            // Handle if the user is not found, e.g., redirect or show an error message
            return redirect()->route('home')->with('error', 'User not found.');
        }

        // Update user information
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        // For debugging, print the hashed password
        // dd($user->password);
        
        // Save the changes
        $user->save();

        // Redirect to a success page or do something else
        return redirect()->route('daftar.user')->with('success', 'User updated successfully.');
    }

    public function edit($id)
    {
        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            // Handle if the user is not found, e.g., redirect or show an error message
            return redirect()->route('home')->with('error', 'User not found.');
        }

        return view('admin.editUser', compact('user'));
    }

    public function destroy($id)
    {
        // Find the user by ID
        $user = User::find($id);

        if ($user) {
            // Delete the user
            $user->delete();
            return redirect()->route('daftar.user')->with('success', 'User deleted successfully.');
        }

        // Handle if the user is not found
        return redirect()->route('home')->with('error', 'User not found.');
    }


}