<x-layout>

    <x-card class="mb-5 bg-white text-xs">

        <h2 class="mb-2 text-yellow-500 font-bold text-xl text-left">
            All Projects
        </h2>

        <!-- Intro text for filter usage -->
        <p class="mb-2">
            Use the filters below to narrow down the list of projects and quickly find exactly what you’re looking for. Adjust the title or start date to refine your results.
        </p>

        <!-- Filter Form -->
        <form id="filter-form" action="{{ route('projects.index') }}" method="GET">

            <!-- Filter inputs in a 2-column grid -->
            <div class="mb-2 grid grid-cols-2 gap-2">

                <!-- Project Title Filter -->
                <div>
                    <x-label text="Project Title" />
                    <x-text-field
                        form-id="filter-form"
                        type="text"
                        name="title-search"
                        value="{{ request('title-search') }}"
                        placeholder="Search by Project Title" />
                </div>

                <!-- Start Date Filter -->
                <div>
                    <x-label text="Start Date" />
                    <x-text-field
                        type="date"
                        name="date-search"
                        value="{{ request('date-search') }}" />
                </div>
            </div>

            <!-- Filter and Clear Buttons -->
            <div class="flex justify-center space-x-3">
                <!-- Filter Submit Button -->
                <x-button text="Filter"></x-button>

                <!-- Clear Filters Button (JS will clear inputs and resubmit) -->
                <button type="button"
                    onclick="clearAndSubmit('filter-form', ['title-search', 'date-search'])"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded shadow transition duration-200">
                    Clear Filters
                </button>
            </div>
        </form>
    </x-card>

    <!-- Pagination info above the list -->
    <div class="flex justify-between items-center mb-4 text-sm text-gray-600">
        <p>
            Page {{ $projects->currentPage() }} of {{ $projects->lastPage() }}
        </p>
        {{ $projects->links() }}
    </div>

    <!-- Loop through projects and display each -->
    @foreach($projects as $project)
    <x-card class="mb-2 bg-white">

        <!-- Project title linked to its detail page -->
        <div class="mb-2 flex justify-between items-center">
            <a href="{{ route('projects.show', $project->id) }}" class="block">
                <h3 class="text-lg font-bold text-yellow-500 hover:underline">{{ $project->title }}</h3>
            </a>
        </div>

        <!-- Project start date -->
        <div class="text-xs text-gray-60 mb-1">
            <strong>Start:</strong> {{ $project->start_date->format('d M Y') }}
        </div>

        <!-- Short description -->
        <p class="text-sm">
            {!! nl2br(e($project->short_description)) !!}
        </p>
    </x-card>
    @endforeach

    <!-- Message when no projects are found -->
    @forelse ($projects as $project)
    @empty
    <x-card class="bg-white text-xs">
        <p class="text-center text-slate-600">No projects found.</p>
    </x-card>
    @endforelse

    <!-- Pagination info below the list -->
    <div class="flex justify-between items-center mt-6 text-sm text-gray-600">
        <p>
            Page {{ $projects->currentPage() }} of {{ $projects->lastPage() }}
        </p>
        {{ $projects->links() }}
    </div>

</x-layout>