<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/webp" sizes="16x16" href="{{ asset('assets/smkmerdekabandunglogo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
    @yield('header')
</head>
<body class="bg-[#E8F1F2] min-h-screen">
    <header>
        @includeWhen($authUser?->role === 'admin', 'web.includes.navbar_admin')
        @includeWhen($authUser?->role === 'student', 'web.includes.navbar_student')
    </header>
    <main>
        @yield('content')
        @yield('scripts')
    </main>
</body>
</html>

