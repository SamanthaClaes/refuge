<!DOCTYPE html>
<html
    x-data
    x-init="
    console.log('Alpine INIT OK');

    Livewire.on('open-modal', () => {
        console.log('EVENT open-modal reçu');
        document.documentElement.style.overflow = 'hidden';
    });

    Livewire.on('close-modal', () => {
        console.log('EVENT close-modal reçu');
        document.documentElement.style.overflow = '';
    });
  "
>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }} </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body>
<header>
    <x-header.side-bar/>
</header>
{{ $slot }}

@livewireScripts
</body>
</html>
