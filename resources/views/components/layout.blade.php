@props([
    'title' => 'Halaman'
])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>{{ $title }}</title>
</head>
<body class="bg-gradient-to-br from-black to-[#9b5000] min-h-screen text-amber-50 font-sans">
    <x-flash-msg />
    
    <x-ui.navigasi />

    <!-- Konten Halaman -->
    <main class="mx-auto">
        {{ $slot }}
    </main>

</body>
</html>