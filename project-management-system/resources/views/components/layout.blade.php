<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artisan Serve Consulting</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-yellow-50 h-full flex flex-col min-h-screen">

    <header class="bg-yellow-500 w-full mb-5">
        <div class="mx-auto max-w-2xl flex flex-col md:flex-row justify-between items-center py-10 px-4">
            <a href="{{ url('/') }}" class="text-white text-2xl">
                <span class="font-bold">
                    ArtisanServe
                </span>
                Consulting
            </a>
            <nav class="flex gap-4 mt-4 md:mt-0">
                <a href="{{route('projects.index')}}" class="text-white px-2 hover:underline">All Projects</a>

                @auth
                <a href="{{ route('projects.my') }}" class="text-white px-2 hover:underline">My Projects</a>

                <form action="{{ route('authentication.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="text-white px-2 hover:underline cursor-pointer">Logout</button>

                </form>

                @else
                <a href="{{route(name: 'authentication.create')}}" class="text-white px-2 hover:underline">Login</a>

                @endauth

            </nav>
        </div>
    </header>

    {{-- Flash success message --}}
    @if (session('success'))
    <div data-flash class="mb-4 mx-auto w-fit rounded-md bg-green-50 border border-green-200 text-green-700 text-sm px-3 py-2 text-center">
        {{ session('success') }}
    </div>
    @endif

    {{-- Flash error message --}}
    @if (session('error'))
    <div data-flash class="mb-4 mx-auto w-fit rounded-md bg-red-50 border border-red-200 text-red-700 text-sm px-3 py-2 text-center">
        {{ session('error') }}
    </div>
    @endif

    <main class="flex-1 w-full mx-auto max-w-2xl px-4">
        {{ $slot }}
    </main>

    <footer class="bg-yellow-500 text-white py-6 mt-10 w-full">
        <div class="max-w-2xl w-full mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex space-x-4 text-xl">
                <a href="https://github.com/Branticus94" target="_blank" rel="noopener noreferrer" title="GitHub"
                    class="hover:text-yellow-800 transition-colors duration-200">
                    <i class="fa-brands fa-github"></i>
                </a>
                <a href="https://www.linkedin.com/in/alexandra-howland-79a587334/" target="_blank" rel="noopener noreferrer" title="LinkedIn"
                    class="hover:text-yellow-800 transition-colors duration-200">
                    <i class="fa-brands fa-linkedin"></i>
                </a>
                <a href="mailto:240360896@aston.ac.uk" title="Email Alexandra"
                    class="hover:text-yellow-800 transition-colors duration-200">
                    <i class="fa fa-envelope"></i>
                </a>
            </div>

            <div class="text-xs text-center md:text-right space-y-1">
                <p>&copy; 2025 Alexandra Howland</p>
                <p>Email: <a href="mailto:240360896@aston.ac.uk" class="hover:underline">240360896@aston.ac.uk</a></p>
                <p>SUN: 240360896</p>
            </div>
        </div>
    </footer>