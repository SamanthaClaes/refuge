<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<h1 class="sr-only">Pages principales de l’admin</h1>
<header>
    <x-header.side-bar/>
</header>
<body class="bg-background ">
<main class="pl-72 pr-12 pt-8 pb-10 min-h-screen">
    {{ $slot }}
</main>
@livewireScripts
</body>
