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
        margin-top: 200px;
    }

    input, select {
        margin: 10px 0;
        padding: 10px;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #e6e6fa;
        font-size: 16px;
    }

    .total-input {
        background-color: #f0f8ff;
        font-weight: bold;
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

    .warning {
        color: red;
        font-weight: bold;
        margin-top: 10px;
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
</style>
<body>
        <!-- Modal Popup -->
        <div id="modalAnggaran" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Perhitungan Konsumsi</h2>
                <form action="{{ route('konsumsi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_jadwal" value="{{ request('id_jadwal') }}">

                    <label for="jenis_konsumsi">Jenis Konsumsi:</label>
                    <select id="jenis_konsumsi" name="jenis_konsumsi" required>
                        <option value="" disabled {{ old('jenis_konsumsi', session('form.konsumsi.jenis_konsumsi')) == '' ? 'selected' : '' }}>Pilih jenis konsumsi</option>
                        <option value="Snack" {{ old('jenis_konsumsi', session('form.konsumsi.jenis_konsumsi')) == 'Snack' ? 'selected' : '' }}>Snack</option>
                        <option value="Nasi" {{ old('jenis_konsumsi', session('form.konsumsi.jenis_konsumsi')) == 'Nasi' ? 'selected' : '' }}>Nasi</option>
                        <option value="Snack dan Nasi" {{ old('jenis_konsumsi', session('form.konsumsi.jenis_konsumsi')) == 'Snack dan Nasi' ? 'selected' : '' }}>Nasi + Snack</option>
                    </select>

                    <label for="jumlah">Jumlah:</label>
                    <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', session('form.konsumsi.jumlah')) }}" placeholder="Masukkan jumlah" oninput="hitungTotal()"required><br><br>
                    <label for="harga">Harga:</label>
                    <input type="number" id="harga" name="harga" value="{{ old('harga', session('form.konsumsi.harga')) }}" placeholder="Masukkan harga" oninput="hitungTotal()"required><br><br>

                    <label for="pajakPersen">Pajak (%):</label>
                    <input type="number" id="pajakPersen" name="pajak" value="{{ old('pajak', session('form.konsumsi.pajak')) }}" placeholder="Masukkan persen pajak" oninput="hitungTotal()"required><br><br>

                    <label for="anggaran">Anggaran:</label>
                    <input type="number" id="anggaran" name="anggaran" value="{{ old('anggaran', session('form.konsumsi.anggaran')) }}" placeholder="Masukkan anggaran" oninput="hitungTotal()"required><br><br>

                    <label for="total">Total:</label>
                    <input type="text" id="total" name="total" class="total-input" readonly>

                    <div id="warning" class="warning" style="display: none;"></div>

                    <a href="{{ route('form.jadwal') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Next</button>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <script>
            function hitungTotal() {
                let jumlah = parseFloat(document.getElementById('jumlah').value) || 0;
                let harga = parseFloat(document.getElementById('harga').value) || 0;
                let pajakPersen = parseFloat(document.getElementById('pajakPersen').value) || 0;

                let subtotal = jumlah * harga;
                let pajak = subtotal * (pajakPersen / 100);
                let total = subtotal + pajak;

                document.getElementById('total').value = total.toFixed(2);

                let anggaran = parseFloat(document.getElementById('anggaran').value) || 0;
                let warning = document.getElementById('warning');

                if (total > anggaran && anggaran !== 0) {
                    warning.style.display = 'block';
                    warning.textContent = '⚠️ Total melebihi anggaran!';
                } else {
                    warning.style.display = 'none';
                }
            }

            function closeModal() {
                document.getElementById('modalAnggaran').style.display = 'none';
            }

            window.onload = function () {
                document.getElementById('modalAnggaran').style.display = 'flex';
                hitungTotal(); // Trigger jika data lama ada
            };
            // Mengecek apakah form valid
        </script>
    </body>
</html>
@endsection
