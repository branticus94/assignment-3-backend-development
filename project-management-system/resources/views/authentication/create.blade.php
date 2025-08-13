<x-layout>
    <div class="flex-1 flex flex-col items-center">

        <!-- Card container for the login form -->
        <x-card class="mb-5 bg-white text-xs w-full max-w-sm">

            <!-- Login heading -->
            <h2 class="mb-6 text-yellow-500 font-bold text-xl text-center">
                Login to your account
            </h2>

            <!-- Login form -->
            <form id="login-form" action="{{ route('authentication.store') }}" method="POST" class="flex flex-col space-y-4">
                <!-- CSRF token for security -->
                @csrf

                <!-- Username input -->
                <div>
                    <x-label class="block mb-1" text="Username" />
                    <x-text-field
                        class="w-full"
                        form-id="login-form"
                        type="text"
                        name="username"
                        value="{{ request('title-search') }}"
                        placeholder="Enter your username" />
                </div>

                <!-- Password input -->
                <div>
                    <x-label class="block mb-1" text="Password" />
                    <x-text-field
                        class="w-full"
                        form-id="login-form"
                        type="password"
                        name="password"
                        value="{{ request('title-search') }}"
                        placeholder="Enter your password" />
                </div>

                <!-- Remember me checkbox and forgot password link -->
                <div class="mb-2 flex justify-between items-center text-xs font-medium mx-2">
                    <div class="flex items-center space-x-2">
                        <input
                            type="checkbox"
                            id="remember"
                            class="rounded border-gray-300 text-yellow-500 focus:ring-yellow-400">
                        <label for="remember" class="text-yellow-500 cursor-pointer">Remember me</label>
                    </div>

                    <!-- Registration link -->
                    <p class="text-center">
                        Not a user?
                        <a href="{{ route('register') }}" class="text-yellow-500 hover:underline">Sign up here</a>
                    </p>
                </div>

                <!-- Submit button -->
                <div class="flex justify-center">
                    <x-button text="Login"></x-button>
                </div>

            </form>

        </x-card>

    </div>

</x-layout>