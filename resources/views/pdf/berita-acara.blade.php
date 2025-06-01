<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Berita Acara Rapat</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12pt;
        }
        .center {
            text-align: center;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .content {
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="content">
      <img src="{{ public_path('foto/Logo.jpg') }}" width="50">
      <div class="center" style="margin-top:-70px;">
            <h4>FORMULIR <br> BERITA ACARA RAPAT</h4>
        </div>
        <hr>
        <div class="center">
            <strong>BERITA ACARA RAPAT KALURAHAN PURWOMARTANI</strong>
        </div>

        <p>Pada tanggal {{ $tanggal }} di ruang {{ $ruang }} telah dilaksanakan Rapat "{{ $nama_rapat }}" yang dihadiri oleh {{ $jumlah_peserta }} peserta.</p>

        <p>Rapat ini telah membahas:</p>
        <ol>
            <li>{{ $hasil_rapat }}</li>
        </ol>

        <p>Demikian Berita Acara ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>

        <div class="signature">
            <p>Mengetahui,</p>
            <p>Lurah Purwomartani</p>
            <br><br><br>
            <p><strong>H. Semiono</strong><br>NIK.</p>
        </div>
    </div>
</body>
</html>
