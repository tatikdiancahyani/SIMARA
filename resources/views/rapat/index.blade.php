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
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
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
        background-color: #e6e6fa;
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
    <h1>Jadwal Rapat {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('l, d F Y') }}</h1>

    <form action="{{ route('rapat') }}" method="GET" style="display: flex; gap: 15px; justify-content: flex-end; align-items: center; margin-bottom: 1.5rem">
        <div>Pilih Tanggal:</div>
        <input type="date" id="date_filter" name="date" value="{{ $selectedDate }}" style="margin: 0px; width: 200px;">
        <button type="submit" style="width: 128px;">Filter</button>
    </form>

    <!-- Notifikasi -->
    @if(session('success'))
    <p class="alert alert-success">{{ session('success') }}</p>
    @endif

    @if(session('error'))
    <p class="alert alert-danger">{{ session('error') }}</p>
    @endif

    {{-- For displaying validation errors --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if($jadwalRapats->isEmpty())
    <p class="no-data">Tidak ada jadwal rapat untuk tanggal ini.</p>
    @else

    <table border="1" style="width: 100%;" cellspacing="0" cellpadding="5" style="margin-top: 1.5rem">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Tempat</th>
                <th>Deskripsi</th>
                <th>Notulen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwalRapats as $jadwalRapat)
            <tr>
                <td>{{ $jadwalRapat->judul }}</td>
                <td>{{ $jadwalRapat->tanggal }}</td>
                <td>{{ $jadwalRapat->waktu }}</td>
                <td>{{ $jadwalRapat->tempat }}</td>
                <td>{{ $jadwalRapat->deskripsi }}</td>
                <td>
                    @if($jadwalRapat->beritaAcara)
                    <strong>Peserta:</strong> {{ $jadwalRapat->beritaAcara->jumlah_peserta }}
                    <strong>Hasil:</strong> {{ Str::limit($jadwalRapat->beritaAcara->hasil_rapat, 1000) }}
                    <hr />
                    <button type="button" onclick="bukaModal('{{ $jadwalRapat->id_jadwal }}')" class="button create-button"> Ubah Notulen </button>
                    @else
                    <button type="button" onclick="bukaModal('{{ $jadwalRapat->id_jadwal }}')" class="button create-button"> Input Notulen </button>
                    @endif
                    <!-- Modal untuk input/update berita acara (awalnya disembunyikan) -->
                    <div id="modal-{{$jadwalRapat->id_jadwal}}" class="modal" style="display: none;">
                        <div class="modal-content">
                            <div>
                                <span class="close" onclick="tutupModal('{{ $jadwalRapat->id_jadwal }}')">&times;</span>
                            </div>
                            <h1> Notulen</h1>
                            <form action="{{ route('store.berita') }}" method="POST">
                                @csrf
                                <label for="nama_rapat">Nama Rapat</label>
                                <input type="text" id="nama_rapat" name="nama_rapat" placeholder="Masukkan nama rapat"
                                    value="{{ $jadwalRapat->beritaAcara?->nama_rapat ?? $jadwalRapat->judul }}">

                                <label for="tanggal">Tanggal</label>
                                <input type="date" id="tanggal" name="tanggal" placeholder="Masukkan tanggal"
                                    value="{{ $jadwalRapat->beritaAcara?->tanggal ?? $jadwalRapat->tanggal }}">

                                <label for="ruang">Ruang</label>
                                <input type="text" id="ruang" name="ruang" placeholder="Masukkan nama ruang"
                                    value="{{ $jadwalRapat->beritaAcara?->ruang ?? $jadwalRapat->tempat }}">

                                <label for="jumlah_peserta">Jumlah Peserta</label>
                                <input type="number" id="jumlah_peserta" name="jumlah_peserta" placeholder="Masukkan jumlah peserta"
                                    value="{{ $jadwalRapat->beritaAcara?->jumlah_peserta }}">

                                <label for="hasil_rapat">Hasil Rapat</label>
                                <textarea id="hasil_rapat" name="hasil_rapat" class="form-control" placeholder="Masukkan hasil rapat">{{ $jadwalRapat->beritaAcara?->hasil_rapat }}</textarea>

                                <input type="hidden" name="id_jadwal" value="{{ $jadwalRapat->id_jadwal }}" />

                                <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function bukaModal(id) {
            document.getElementById('modal-' + id).style.display = 'flex';
        }

        function tutupModal(id) {
            document.getElementById('modal-' + id).style.display = 'none';
        }
    </script>

    @endif
</body>

</html>
@endsection