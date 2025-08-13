<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\RegistrationController;

// Project Routes

/**
 * Redirect root URL to the projects index page.
 */
Route::get('/', fn(): RedirectResponse => to_route('projects.index'));

// Display a paginated list of projects (public access)
Route::get('projects', [ProjectController::class, 'index'])
    ->name('projects.index');

// Show the form to create a new project (authenticated users only)
Route::get('projects/create', [ProjectController::class, 'create'])
    ->name('projects.create')
    ->middleware('auth');

// Store a new project in the database (authenticated users only)
Route::post('projects', [ProjectController::class, 'store'])
    ->name('projects.store')
    ->middleware('auth');

// Show a single project's details (public access)
Route::get('projects/{project}', [ProjectController::class, 'show'])
    ->name('projects.show');

// Display the authenticated user's own projects
Route::get('my-projects', [ProjectController::class, 'myProjects'])
    ->name('projects.my')
    ->middleware('auth');

// Show the form to edit an existing project (owner only)
Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])
    ->name('projects.edit')
    ->middleware('auth');

// Update an existing project (owner only)
Route::put('projects/{project}', [ProjectController::class, 'update'])
    ->name('projects.update')
    ->middleware('auth');

// Delete a project (owner only)
Route::delete('projects/{project}', [ProjectController::class, 'destroy'])
    ->name('projects.destroy')
    ->middleware('auth');

//Authentication Routes

// Resource routes for authentication (only login form and login handling)
Route::resource('authentication', AuthenticationController::class)
    ->only(['create', 'store']);

// Redirect the default /login URL to the login form
Route::get('login', action: fn(): RedirectResponse => to_route('authentication.create'))->name('login');

// Handle user logout
Route::delete('logout', action: [AuthenticationController::class, 'destroy'])
    ->name('authentication.destroy');

//Registration Routes

Route::middleware('guest')->group(function () {
    // Show the registration form
    Route::get('/register', [RegistrationController::class, 'create'])
        ->name('register');

    // Handle registration form submission
    Route::post('/register', [RegistrationController::class, 'store'])
        ->name('register.store'); // <-- NOT 'register'
});
