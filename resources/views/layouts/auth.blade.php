<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title', 'Authentication')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Additional Styles -->
    @stack('styles')
</head>

<body class="bg-gray-100">
    <!-- Simple Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('welcome') }}" class="text-xl font-bold text-gray-800">
                            {{ config('app.name', 'Sistem PKL') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Simple Footer -->
    <footer class="bg-white shadow-lg mt-8">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 text-sm">
                © {{ date('Y') }} {{ config('app.name', 'Sistem PKL') }}. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    @stack('scripts')
</body>

</html>