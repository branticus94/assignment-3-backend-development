<x-layout>

    <!-- Back link to previous page -->
    <a href="{{ url()->previous() }}"
        class="inline-block mb-2 text-sm text-yellow-500 hover:text-yellow-800 hover:underline transition duration-150 ease-in-out">
        ← Back
    </a>

    <!-- Card container for project details -->
    <x-card class="mb-4 bg-white">

        <!-- Project title and phase badge -->
        <div class="mb-2 flex justify-between items-center ">
            <!-- Project title -->
            <h3 class="text-lg font-bold text-yellow-500">{{ $project->title }}</h3>

            <!-- Project phase (styled as badge) -->
            <span class="text-xs text-white font-semibold px-3 py-1 rounded-full bg-yellow-500">
                {{ ucfirst($project->phase) }}
            </span>
        </div>

        <!-- Project dates -->
        <div class="text-xs text-gray-60 mb-1">
            <strong>Start:</strong> {{ $project->start_date->format('d M Y') }}
            <span class="mx-1 text-gray-400">|</span>

            <!-- Show end date if available, otherwise "Currently active" -->
            @if ($project->end_date)
            <strong>End:</strong> {{ $project->end_date->format('d M Y') }}
            @else
            <strong>End:</strong> Currently active
            @endif
        </div>

        <!-- Short project description -->
        <p class="text-sm mb-2">
            {!! nl2br(e($project->short_description)) !!}
        </p>

        <!-- Project owner details -->
        <p class="text-xs text-gray-60">
            <strong>Project Owner:</strong>
            {{ $project->user->username ?? 'Unknown' }}
            <!-- If user email exists, display it in brackets -->
            @if($project->user?->email)
            ({{ $project->user->email }})
            @endif
        </p>

    </x-card>
</x-layout>