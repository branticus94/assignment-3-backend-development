<x-layout>
    <div class="flex-1 flex flex-col items-center">

        <!-- Return to Login Button -->
        <div class="w-full max-w-sm mb-4">
            <a href="{{ route('login') }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-medium px-3 py-2 rounded-md shadow-sm transition duration-150 ease-in-out">
                ← Back to Login
            </a>
        </div>

        <x-card class="mb-5 bg-white text-xs w-full max-w-sm">
            <h2 class="mb-6 text-yellow-500 font-bold text-xl text-center">
                Create your account
            </h2>

            <form id="register-form" action="{{ route('register.store') }}" method="POST" class="flex flex-col space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <x-label class="block mb-2" text="Name" />
                    <x-text-field
                        class="w-full"
                        form-id="register-form"
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        placeholder="Your username" />
                    @error('username') <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div>
                    <x-label class="block mb-2" text="Email" />
                    <x-text-field
                        class="w-full"
                        form-id="register-form"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="you@example.com" />
                    @error('email') <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Password -->
                <div>
                    <x-label class="block mb-2" text="Password" />
                    <x-text-field
                        class="w-full"
                        form-id="register-form"
                        type="password"
                        name="password"
                        placeholder="••••••••" />
                    @error('password') <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-label class="block mb-2" text="Confirm Password" />
                    <x-text-field
                        class="w-full"
                        form-id="register-form"
                        type="password"
                        name="password_confirmation"
                        placeholder="••••••••" />
                </div>

                <!-- Submit -->
                <div class="flex justify-center">
                    <x-button type="submit" text="Sign Up"></x-button>
                </div>

            </form>
        </x-card>
    </div>
</x-layout>