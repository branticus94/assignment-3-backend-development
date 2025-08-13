<x-layout>
    <div class="flex-1 flex flex-col items-center">

        <!-- Back to My Projects -->
        <div class="w-full max-w-md mb-4">
            <a href="{{ route('projects.my') }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-medium px-3 py-2 rounded-md shadow-sm transition">
                ← Back to My Projects
            </a>
        </div>

        <x-card class="mb-5 bg-white text-xs w-full max-w-md">
            <h2 class="mb-6 text-yellow-500 font-bold text-xl text-center">
                Create a new project
            </h2>

            <form id="project-create-form" action="{{ route('projects.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Title -->
                <div>
                    <x-label class="block mb-1" text="Title" />
                    <x-text-field
                        class="w-full @error('title') border-red-500 @enderror"
                        form-id="project-create-form"
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Project Title" />
                    @error('title') <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Start date -->
                <div>
                    <x-label class="block mb-1" text="Start date" />
                    <x-text-field
                        class="w-full @error('start_date') border-red-500 @enderror"
                        form-id="project-create-form"
                        type="date"
                        name="start_date"
                        value="{{ old('start_date') }}" />
                    @error('start_date') <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- End date -->
                <div>
                    <x-label class="block mb-1" text="End date (optional)" />
                    <x-text-field
                        class="w-full @error('end_date') border-red-500 @enderror"
                        form-id="project-create-form"
                        type="date"
                        name="end_date"
                        value="{{ old('end_date') }}" />
                    @error('end_date') <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Short description -->
                <div>
                    <x-label class="block mb-1" text="Short description" />
                    <textarea
                        name="short_description"
                        class="w-full rounded border px-3 py-2 text-sm @error('short_description') border-red-500 @enderror"
                        rows="4"
                        placeholder="Summary of the project">{{ old('short_description') }}</textarea>
                    @error('short_description') <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Phase -->
                <div>
                    <x-label class="block mb-1" text="Phase" />
                    <select name="phase"
                        class="w-full rounded border px-3 py-2 text-sm @error('phase') border-red-500 @enderror">
                        @php
                        $phases = ['design','development','testing','deployment','complete'];
                        @endphp
                        <option value="" disabled {{ old('phase') ? '' : 'selected' }}>Select a phase…</option>
                        @foreach ($phases as $phase)
                        <option value="{{ $phase }}" {{ old('phase') === $phase ? 'selected' : '' }}>
                            {{ ucfirst($phase) }}
                        </option>
                        @endforeach
                    </select>
                    @error('phase') <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Submit & Clear -->
                <div class="flex justify-center space-x-3">
                    <x-button text="Create Project" />

                    <button type="button"
                        onclick="document.getElementById('project-create-form').reset();"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded shadow transition duration-200">
                        Clear All
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</x-layout>