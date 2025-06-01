<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notulen Rapat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }
        .container {
            width: 595px;
            border: 1px solid #000;
            padding: 20px;
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
        .warning {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('foto/Logo.jpg') }}" alt="Logo">
            <div class="title">
                <h1>FORMULIR</h1>
                <h1>BERITA ACARA RAPAT</h1>
            </div>
        </div>
        
        <div class="content">
            <h2>BERITA ACARA RAPAT KALURAHAN PURWOMARTANI</h2>
            <p>Pada tanggal {{ $tanggal }} di ruang {{ $ruang }} telah dilaksanakan Rapat "{{ $nama_rapat }}" yang dihadiri oleh {{ $jumlah_peserta }} peserta.</p>
            <p>Rapat ini telah membahas:</p>
            <ol>
                <li>{{ $hasil_rapat }}</li>
            </ol>
            <p>Demikian Berita Acara ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>
        <div class="footer">
            <p>Mengetahui,</p>
            <p>Lurah Purwomartani</p>
            <div class="signature">
                <p>H. Semiono</p>
                <p>NIK.</p>
            </div>
        </div>
    </div>
</body>
</html>
