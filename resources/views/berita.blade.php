@extends('layouts.app')

@section('title', 'Berita Acara')

@section('contents')
    <html>
    <head>
    <title>
    Berita Acara Rapat
    </title>
    <style>
        body {
               font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                /*display: flex;
                justify-content: center;
                align-items: center;*/
                background-color: #fff;
            }

            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #000;
                padding-bottom: 10px;
                margin-bottom: 10px;
            }
            .header img {
                width: 150px;
                height: 150px;
            }
            .header .title {
                text-align: center;
                flex-grow: 1;
            }
            .header .title h1 {
                font-size: 14px;
                margin: 0;
            }
            .header .info {
                text-align: right;
                font-size: 12px;
            }
            .content {
                text-align: justify;
                font-size: 14px;
            }
            .content h2 {
                text-align: center;
                font-size: 14px;
                margin: 20px 0;
            }
            .content p {
                margin: 10px 0;
            }
            .content ol {
                margin: 10px 0;
                padding-left: 20px;
            }
            .footer {
                margin-top: 20px;
                text-align: right;
                font-size: 14px;
            }
            .footer .signature {
                margin-top: 40px;
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
            .total-input {
                background-color: #f0f8ff;
                font-weight: bold;
            }

            .warning {
                color: red;
                font-weight: bold;
                margin-top: 10px;
            }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4); /* Background dengan transparansi */
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Lebar modal */
            max-width: 600px; /* Lebar maksimal modal */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    </head>
            <div class="container">
                <!-- Tombol untuk menampilkan form -->

                <!-- Modal untuk input berita acara (awalnya disembunyikan) -->
                <div id="modalBeritaAcara" class="modal" style="display: none;">
                    <div class="modal-content">
                        <span id="closeModal" class="close">&times;</span>
                        <h1>Input Berita Acara</h1>
                        <form action="{{ route('store.berita') }}" method="POST">
                            @csrf
                            <label for="nama_rapat">Nama Rapat</label>
                            <input type="text" id="nama_rapat" name="nama_rapat" placeholder="Masukkan nama rapat">

                            <label for="tanggal">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" placeholder="Masukkan tanggal">

                            <label for="ruang">Ruang</label>
                            <input type="text" id="ruang" name="ruang" placeholder="Masukkan nama ruang">

                            <label for="jumlah_peserta">Jumlah Peserta</label>
                            <input type="number" id="jumlah_peserta" name="jumlah_peserta" placeholder="Masukkan jumlah peserta">

                            <label for="hasil_rapat">Hasil Rapat</label>
                            <textarea id="hasil_rapat" name="hasil_rapat" class="form-control" placeholder="Masukkan hasil rapat"></textarea>

                            <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                        </form>
                    </div>
                </div>

                <!-- Menampilkan tabel jika ada data berita acara -->
                @if($beritaAcara->isNotEmpty())
                    <table border="1" cellspacing="0" cellpadding="5" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Rapat</th>
                                <th>Tanggal</th>
                                <th>Ruang</th>
                                <th>Jumlah Peserta</th>
                                <th>Hasil Rapat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($beritaAcara as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama_rapat }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->ruang }}</td>
                                <td>{{ $item->jumlah_peserta }}</td>
                                <td>{{ $item->hasil_rapat }}</td>
                                <td>
                                    @if(isset($item->id_berita_acara) && $item->id_berita_acara)
                                        <a href="{{ route('berita-acara.download', ['id' => $item->id_berita_acara]) }}">Download PDF</a>
                                    @else
                                        <span class="text-danger">ID Input tidak tersedia</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Tidak ada data berita acara.</p>
                @endif
            </div>

            <script>
                // Ambil elemen tombol dan modal
                const tambahButton = document.getElementById('tambahBeritaAcaraBtn');
                const modal = document.getElementById('modalBeritaAcara');
                const closeModal = document.getElementById('closeModal');

                // Tambahkan event listener pada tombol untuk menampilkan modal
                tambahButton.addEventListener('click', function() {
                    modal.style.display = 'block';
                });

                // Tambahkan event listener pada tombol close untuk menutup modal
                closeModal.addEventListener('click', function() {
                    modal.style.display = 'none';
                });

                // Tutup modal jika pengguna mengklik di luar modal
                window.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        modal.style.display = 'none';
                    }
                });
            </script>
    </body>
    </html>
@endsection
