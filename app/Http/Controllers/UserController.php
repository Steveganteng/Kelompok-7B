<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show the form to create a new user.
     */
    public function create()
    {
        // Return the view for creating a user
        return view('admin.create_user');
    }

    /**
     * Store a newly created user in the database.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:superadmin,apoteker,dokter',
        ]);

        // Create a new user in the database
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Redirect to the user list or another page with a success message
        return redirect()->route('admin.createUser')->with('success', 'User successfully created!');
    }
}
