<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ isset($title) ? $title . ' - ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>

        @fonts

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center min-h-screen flex-col antialiased">
        @include('partials.header')

        @if (session('status'))
            <div class="w-full lg:max-w-4xl max-w-[335px] mb-4 p-4 rounded-lg bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-sm flex items-center justify-between">
                <span>{{ session('status') }}</span>
                <span class="text-xs bg-emerald-200 dark:bg-emerald-800 px-2 py-0.5 rounded font-medium">Éxito</span>
            </div>
        @endif

        <main class="w-full lg:max-w-4xl max-w-[335px] flex-1 flex flex-col items-center justify-center">
            @yield('content')
        </main>
    </body>
</html>
