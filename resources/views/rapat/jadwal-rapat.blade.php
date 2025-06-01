@extends('layouts.app') 
@section('contents')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .modal {
        display: none; 
        position: fixed; 
        z-index: 50; 
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    .close {
        float: right;
        font-size: 28px;
        font-weight: bold;
        color: #aaa;
        cursor: pointer;
    }

    .close:hover {
        color: black;
    }

    input {
        margin: 10px 0;
        padding: 10px;
        width: 100%;
        border: none;
        border-radius: 5px;
        background-color:  #e6e6fa;
        font-size: 16px;
    }

    button {
        background-color: #6a5acd;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
    }

    button:hover {
        background-color: #5a4cac;
    }
</style>
<body>
<!-- Notifikasi -->
@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>

        <h2>Tambah Jadwal Rapat</h2>
        <form action="{{ route('jadwal-rapat.store') }}" method="POST">
            @csrf

            <label for="judul">Judul Rapat:</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', session('form.jadwal.judul')) }}"required><br><br>

            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', session('form.jadwal.tanggal')) }}"required><br><br>

            <label for="waktu">Waktu:</label>
            <input type="time" id="waktu" name="waktu" value="{{ old('waktu', session('form.jadwal.waktu')) }}"required><br><br>

            <label for="tempat">Tempat:</label>
            <input type="text" id="tempat" name="tempat" value="{{ old('tempat', session('form.jadwal.tempat')) }}"required><br><br>

            <button type="submit" class="btn btn-primary">Next</button>

        </form>
    </div>
</div>
<!-- Script -->
<script>
    // Modal muncul otomatis saat halaman dibuka
    window.onload = function() {
        document.getElementById('modal').style.display = 'flex';
    };
    function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }
</script>
</body>
</html>
@endsection
              