<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    /**
     * Show the login form to the user.
     *
     * This method returns the Blade view for creating a new user
     * authentication session (login page).
     */
    public function create()
    {
        return view("authentication.create");
    }

    /**
     * Handle an incoming authentication request.
     *
     * This method validates the login form, attempts to authenticate
     * the user, and then redirects them accordingly.
     
     */
    public function store(Request $request)
    {
        // Validate that both username and password are provided
        request()->validate([
            "username" => 'required',
            "password" => 'required'
        ]);

        // Extract only the username and password from the request
        $credentials = $request->only('username', 'password');

        // Determine if the "remember me" checkbox was selected
        $remember = $request->filled('remember');

        // Attempt to log in the user with the provided credentials
        if (Auth::attempt($credentials, $remember)) {
            // Authentication passed — redirect to intended page or homepage
            return redirect()->intended('/');
        } else {
            // Authentication failed — redirect back with error message
            return redirect()->back()->with('error', 'Invalid login information');
        }
    }

    /**
     * Log the user out and destroy their session.
     *
     * This method handles the logout process by:
     *  - Logging out the currently authenticated user.
     *  - Invalidating the current session data to prevent reuse.
     *  - Regenerating the CSRF token for security.
     *  - Redirecting the user to the homepage.
     */
    public function destroy()
    {
        // Log out the currently authenticated user
        Auth::logout();

        // Invalidate the current session to remove all stored data
        request()->session()->invalidate();

        // Generate a new CSRF token to prevent token fixation attacks
        request()->session()->regenerateToken();

        // Redirect the user to the home page
        return redirect('/');
    }
}
