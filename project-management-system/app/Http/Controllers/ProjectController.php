<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a list of all projects.
     *
     * Applies optional filters:
     *  - title-search: match projects by title (partial match)
     *  - date-search: match projects starting on/after a given date
     * Orders results by start date (newest first) and paginates.
     */
    public function index()
    {
        $projects = Project::query()

            // Filter by title if "title-search" query parameter exists
            ->when(request('title-search'), function ($query) {
                $query->where('title', 'like', '%' . request('title-search') . '%');
            })

            // Filter by start date if "date-search" query parameter exists
            ->when(request('date-search'), function ($query) {
                $query->whereDate('start_date', '>=', request('date-search'));
            })

            // Show newest projects first
            ->orderByDesc('start_date')

            // Paginate results (10 per page) and retain filters in query string
            ->paginate(10)
            ->withQueryString();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created project in the database.
     *
     * Validates input, associates the project with the logged-in user,
     * and then redirects to the "My Projects" page.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'start_date'        => 'required|date',
            'end_date'          => 'nullable|date|after_or_equal:start_date',
            'short_description' => 'required|string',
            'phase'             => 'required|in:design,development,testing,deployment,complete',
        ]);

        // Link the project to the current authenticated user
        $validated['user_id'] = Auth::id();

        // Create the project record in the database
        Project::create($validated);

        return to_route('projects.my')
            ->with('success', 'Project created successfully!');
    }

    /**
     * Display a specific project.
     *
     * Loads the project with its related user information.
     */
    public function show(Project $project)
    {
        $project->load('user');
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form to edit a specific project.
     *
     * Only the project owner can access this page.
     */
    public function edit(Project $project)
    {
        // Deny access if the current user is not the owner
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Update a specific project.
     *
     * Only the project owner can perform updates.
     */
    public function update(Request $request, Project $project)
    {
        // Deny access if the current user is not the owner
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the updated project details
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'start_date'        => 'required|date',
            'end_date'          => 'nullable|date|after_or_equal:start_date',
            'short_description' => 'required|string|max:1000',
            'phase'             => 'required|in:design,development,testing,deployment,complete',
        ]);

        // Update the project with validated data
        $project->update($validated);

        return to_route('projects.my')
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Delete a specific project.
     *
     * Only the project owner can delete it.
     */
    public function destroy(Project $project)
    {
        // Deny access if the current user is not the owner
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Remove the project from the database
        $project->delete();

        return to_route('projects.my')
            ->with('success', 'Project deleted successfully!');
    }

    /**
     * Display projects owned by the currently authenticated user.
     *
     * Orders projects by start date (newest first) and paginates.
     */
    public function myProjects()
    {
        // Fetch only projects owned by the logged-in user
        $projects = Project::owned(Auth::id())
            ->orderByDesc('start_date')
            ->paginate(10)
            ->withQueryString();

        return view('projects.myprojects', compact('projects'));
    }
}
