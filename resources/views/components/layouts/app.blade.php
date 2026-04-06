<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ theme: localStorage.getItem('theme') || 'system' }"
      x-init="
        const applyTheme = () => {
            const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDark = theme === 'dark' || (theme === 'system' && systemDark);
            document.documentElement.classList.toggle('dark', isDark);
        };
        applyTheme();
        $watch('theme', value => {
            localStorage.setItem('theme', value);
            applyTheme();
        });
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', applyTheme);
    "
      class="bg-background text-foreground"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen font-sans antialiased bg-background text-foreground">
    {{ $slot ?? '' }}

    @livewireScripts
</body>
</html>
