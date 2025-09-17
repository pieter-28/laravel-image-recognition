<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        (function() {
            let theme = localStorage.getItem('theme');
            if (!theme) {
                theme = 'dark'; // default
            }

            if (theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Theme Switcher Script -->
    <script>
        function setTheme(mode) {
            localStorage.setItem('theme', mode);
            applyTheme();
        }

        function applyTheme() {
            let theme = localStorage.getItem('theme');

            if (theme === 'light') {
                document.documentElement.classList.remove('dark');
            } else if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else if (theme === 'system') {
                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } else {
                // default ke dark
                theme = 'dark';
                document.documentElement.classList.add('dark');
            }

            // update tombol aktif
            document.querySelectorAll('.theme-option').forEach(btn => {
                if (btn.dataset.theme === theme) {
                    btn.classList.add("bg-gray-100", "dark:bg-gray-700", "text-gray-400", "font-medium");
                } else {
                    btn.classList.remove("bg-gray-100", "dark:bg-gray-700", "text-gray-400", "font-medium");
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            applyTheme();

            // jika system dipilih, ikut perubahan OS
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                applyTheme();
            });
        });
    </script>
</body>

</html>
