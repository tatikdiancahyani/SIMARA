<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIMARA')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-transparent absolute top-0 left-0 w-full z-10">
        @include('layoutshome.topbar')
    </header>

    <div class="flex">
        @include('layoutshome.sidebar')
        <main class="flex-1">
            @yield('content')
        </main>
    </div>
    @include('layoutshome.footer')

    <script>
        // You can add general script here
    </script>
</body>
</html>