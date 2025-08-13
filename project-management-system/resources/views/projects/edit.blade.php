<x-layout>
    <div class="flex-1 flex flex-col items-center">

        <!-- Return to My Projects Button -->
        <div class="w-full max-w-sm mb-4">
            <a href="{{ route('projects.my') }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-medium px-3 py-2 rounded-md shadow-sm transition duration-150 ease-in-out">
                ← Back to My Projects
            </a>
        </div>

        <x-card class="mb-5 bg-white text-xs w-full max-w-sm">
            <h2 class="mb-6 text-yellow-500 font-bold text-xl text-center">
                Edit Project
            </h2>

            <form id="project-form" action="{{ route('projects.update', $project) }}" method="POST" class="flex flex-col space-y-4">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <x-label class="block mb-2" text="Title" />
                    <x-text-field
                        class="w-full"
                        form-id="project-form"
                        type="text"
                        name="title"
                        value="{{ old('title', $project->title) }}"
                        placeholder="Project title" />
                    @error('title') <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Start Date -->
                <div>
                    <x-label class="block mb-2" text="Start Date" />
                    <x-text-field
                        class="w-full"
                        form-id="project-form"
                        type="date"
                        name="start_date"
                        value="{{ old('start_date', $project->start_date->format('Y-m-d')) }}" />
                    @error('start_date') <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- End Date -->
                <div>
                    <x-label class="block mb-2" text="End Date (optional)" />
                    <x-text-field
                        class="w-full"
                        form-id="project-form"
                        type="date"
                        name="end_date"
                        value="{{ old('end_date', optional($project->end_date)->format('Y-m-d')) }}" />
                    @error('end_date') <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Short Description -->
                <div>
                    <x-label class="block mb-2" text="Short Description" />
                    <textarea
                        name="short_description"
                        rows="4"
                        placeholder="Brief summary of the project…"
                        class="w-full rounded-md py-2 px-3 placeholder:text-slate-300 border-0 ring-1 ring-slate-500 focus:ring-2 focus:ring-yellow-600 outline-0">{{ old('short_description', $project->short_description) }}</textarea>
                    @error('short_description') <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Phase -->
                <div>
                    <x-label class="block mb-2" text="Phase" />
                    <select
                        name="phase"
                        class="w-full rounded-md py-2 px-3 border-0 ring-1 ring-slate-500 focus:ring-2 focus:ring-yellow-600 outline-0">
                        @php
                        $phases = ['design','development','testing','deployment','complete'];
                        @endphp
                        <option value="" disabled {{ old('phase', $project->phase) ? '' : 'selected' }}>Select a phase</option>
                        @foreach ($phases as $phase)
                        <option value="{{ $phase }}" {{ old('phase', $project->phase) === $phase ? 'selected' : '' }}>
                            {{ ucfirst($phase) }}
                        </option>
                        @endforeach
                    </select>
                    @error('phase') <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Submit -->
                <div class="flex justify-center">
                    <x-button text="Update Project"></x-button>
                </div>

            </form>
        </x-card>
    </div>
</x-layout>