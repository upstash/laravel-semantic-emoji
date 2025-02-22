<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image" content="/ogimage.jpg" />

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-white text-black dark:bg-slate-900 dark:text-slate-100 overflow-scroll">
    <div class="max-w-2xl mx-auto px-6 pt-24 pb-12">
        {{ $slot }}
    </div>
    <footer>
        <div class="mx-auto max-w-7xl px-6 py-12 md:py-24 flex flex-col md:items-center md:justify-between lg:px-8 gap-6">
            <div class="flex justify-center gap-x-6">
                <a href="https://github.com/upstash/laravel-semantic-emoji" class="text-gray-600 hover:text-gray-800 dark:hover:text-white">
                    <span class="sr-only">GitHub</span>
                    <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            <p class="text-center text-sm/6 text-black/50 dark:text-white/50 md:order-1 md:mt-0">SemanticEmoji is deployed on <a class="text-green-700 font-medium" href="https://cloud.laravel.com/" target="_blank">Laravel Cloud</a> and uses <a class="text-green-700 font-medium" href="https://upstash.com/" target="_blank">Upstash Vector</a> to store vector embeddings.</p>
        </div>
    </footer>

</body>
</html>
