@extends('layoutshome.app')

@section('title', 'Halaman Utama')

@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMARA</title>
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
    <section class="relative h-screen bg-cover bg-center" style="background-image: url('{{ asset('foto/gedung-purwomartani.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="container mx-auto px-6 py-32 relative z-10 text-center text-white">
            <h1 class="text-5xl font-bold mb-4">Welcome to SIMARA</h1>
            <p class="text-lg mb-8">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
            <a href="{{ route('dashboard') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Mulai</a>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-32" viewBox="0 0 1440 320" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill="#fff" d="M0,320L1440,320L1440,320L0,320Z"></path>
            </svg>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6 bg-gray-100 rounded-lg shadow-md">
                    <div class="text-4xl text-blue-500 mb-4"><i class="fas fa-heartbeat"></i></div>
                    <h3 class="text-xl font-semibold mb-2">Nescuint Mete</h3>
                    <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="text-center p-6 bg-gray-100 rounded-lg shadow-md">
                    <div class="text-4xl text-green-500 mb-4"><i class="fas fa-laptop-code"></i></div>
                    <h3 class="text-xl font-semibold mb-2">Eosle Commodi</h3>
                    <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="text-center p-6 bg-gray-100 rounded-lg shadow-md">
                    <div class="text-4xl text-red-500 mb-4"><i class="fas fa-shopping-cart"></i></div>
                    <h3 class="text-xl font-semibold mb-2">Asperiores</h3>
                    <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

@endsection