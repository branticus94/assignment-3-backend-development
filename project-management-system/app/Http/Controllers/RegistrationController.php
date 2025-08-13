<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    /**
     * Show the registration form.
     *
     * Returns the Blade view that displays the user registration page.
     */
    public function create()
    {
        return view('authentication.register');
    }

    /**
     * Handle the registration request and create a new user.
     *
     * This method:
     *  1. Validates the incoming registration data.
     *  2. Creates a new user record in the database.
     *  3. Hashes the password for secure storage.
     *  4. Logs the new user in immediately.
     *  5. Redirects the user to their projects page with a success message.
     */
    public function store(Request $request)
    {
        // Validate the request data
        // - 'username' must be present, string, and up to 255 characters
        // - 'email' must be a valid email format, unique in the 'users' table
        // - 'password' must be at least 8 characters, and match 'password_confirmation'
        $validated = $request->validate([
            'username'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // needs password_confirmation
        ]);

        // Create a new user record with the validated data
        // The password is hashed for secure storage
        $user = User::create([
            'username'     => $validated['username'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Log the new user in automatically
        Auth::login($user);

        // Redirect to the user's "My Projects" page with a welcome message
        return to_route('projects.my')->with('success', 'Welcome! Account created.');
    }
}
