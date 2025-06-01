 @extends('layouts.app')

@section('contents')
    <style>
        .warning {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
        .total-input {
            background-color: #f0f8ff;
            font-weight: bold;
        }
    </style>
    <h1 class="mb-0">Edit Sarpras</h1>
    <hr />
    <form action="{{ route('sarpras.update', $sarpras->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="container">
            <label for="nama_sarpras" class="form-label">Nama Sarpras</label>
            <input type="text" id="nama_sarpras" name="nama_sarpras" class="form-control" placeholder="Nama Sarpras" value="{{ $sarpras->nama_sarpras }}">
        </div>

        <div class="container">
            <label for="tanggal_pengadaan" class="form-label">Tanggal</label>
            <input type="date" id="tanggal_pengadaan" name="tanggal_pengadaan" class="form-control" placeholder="Nama Sarpras" value="{{ $sarpras->tanggal_pengadaan }}">
        </div>

        <div class="container">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" value="{{ $sarpras->jumlah }}" oninput="hitungTotal()">
        </div>

        <div class="container">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" id="harga" name="harga" class="form-control" placeholder="Harga" value="{{ $sarpras->harga }}" oninput="hitungTotal()">
        </div>

        <div class="container">
            <label for="pajakPersen" class="form-label">Pajak (%)</label>
            <input type="number" id="pajakPersen" name="pajak" class="form-control" placeholder="Pajak" value="{{ $sarpras->pajak }}" oninput="hitungTotal()">
        </div>

        <div class="container">
            <label for="anggaran" class="form-label">Anggaran</label>
            <input type="number" id="anggaran" name="anggaran" class="form-control" placeholder="Anggaran" value="{{ $sarpras->anggaran }}" oninput="hitungTotal()">
        </div>

        <div class="container">
            <label for="total" class="form-label">Total</label>
            <input type="text" id="total" name="total" class="form-control total-input" value="{{ $sarpras->total }}" readonly>
        </div>


        <div class="container">
            <div class="d-grid mt-4">
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>

    <script>
        function hitungTotal() {
            const jumlah = parseFloat(document.getElementById('jumlah').value) || 0;
            const harga = parseFloat(document.getElementById('harga').value) || 0;
            const pajakPersen = parseFloat(document.getElementById('pajakPersen').value) || 0;
            const anggaran = parseFloat(document.getElementById('anggaran').value) || 0;

            // Hitung total harga
            const totalHarga = jumlah * harga;

            // Hitung pajak
            const pajak = (pajakPersen / 100) * totalHarga;
            const total = totalHarga + pajak;

            // Perbarui nilai total
            document.getElementById('total').value = total.toFixed(2);

            // Tampilkan peringatan jika total melebihi anggaran
            const warningDiv = document.getElementById('warning');
            if (total > anggaran && anggaran > 0) {
                if (!warningDiv) {
                    const newWarning = document.createElement('div');
                    newWarning.id = 'warning';
                    newWarning.className = 'warning';
                    newWarning.textContent = 'Peringatan: Total melebihi anggaran!';
                    document.querySelector('form').appendChild(newWarning);
                }
            } else if (warningDiv) {
                warningDiv.remove();
            }
        }
    </script>
@endsection
