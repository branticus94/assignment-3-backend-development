<x-layout>

    <h2 class="mb-2 bg-white rounded-md px-4 py-2 text-yellow-500 font-bold text-xl text-left shadow-sm">
        My Projects
    </h2>

    <!--Add Project + Pagination -->
    <div class="flex justify-between items-center mb-4 text-sm text-gray-600">
        <a href="{{ route('projects.create') }}"
            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md shadow transition duration-150 ease-in-out">
            + Add New Project
        </a>

        <div class="flex items-center gap-4">
            <p>Page {{ $projects->currentPage() }} of {{ $projects->lastPage() }}</p>
            {{ $projects->links() }}
        </div>
    </div>

    <!-- Projects list -->
    @forelse($projects as $project)
    <x-card class="mb-2 bg-white">
        <div class="mb-2 flex justify-between items-center">
            <a href="{{ route('projects.show', $project->id) }}" class="block">
                <h3 class="text-lg font-bold text-yellow-500 hover:underline">{{ $project->title }}</h3>
            </a>

            <div class="flex items-center gap-2">

                <!-- Edit Button -->
                <a href="{{ route('projects.edit', $project) }}"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-xs flex items-center">
                    Edit
                </a>

                <!-- Delete Button -->
                <form action="{{ route('projects.destroy', $project) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this project?');"
                    class="flex items-center">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-amber-700 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs flex items-center cursor-pointer">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="text-xs text-gray-600 mb-1">
            <strong>Start:</strong> {{ $project->start_date->format('d M Y') }}
        </div>

        <p class="text-sm">
            {!! nl2br(e($project->short_description)) !!}
        </p>
    </x-card>
    @empty
    <x-card class="bg-white text-xs">
        <p class="text-center text-slate-600">No projects found.</p>
    </x-card>
    @endforelse

    <!-- Bottom Pagination -->
    <div class="flex justify-between items-center mt-6 text-sm text-gray-600">
        <p>Page {{ $projects->currentPage() }} of {{ $projects->lastPage() }}</p>
        {{ $projects->links() }}
    </div>

</x-layout>