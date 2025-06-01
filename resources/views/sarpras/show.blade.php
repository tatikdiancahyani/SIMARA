 @extends('layouts.app')

@section('contents')
    <style>
    </style>
    <h1 class="mb-0">Detail Sarpras</h1>
    <hr />
    <div class="container">
            <label class="form-label">Nama Sarpras</label>
            <input type="text" name="nama_sarpras" class="form-control" placeholder="Nama Sarpras" value="{{ $sarpras->nama_sarpras }}" readonly>
    </div>
    <div class="container">
            <label class="form-label">Tanggal</label>
            <input type="text" name="tanggal_pengadaan" class="form-control" placeholder="Tanggal" value="{{ $sarpras->tanggal_pengadaan }}" readonly>
    </div>
    <div class="container">
            <label class="form-label">Jumlah</label>
            <input type="text" name="jumlah" class="form-control" placeholder="Jumlah" value="{{ $sarpras->jumlah }}" readonly>
    </div>
    <div class="container">
            <label class="form-label">Harga</label>
            <input type="text" name="harga" class="form-control" placeholder="Harga" value="{{ $sarpras->harga }}" readonly>
    </div>
    <div class="container">
            <label class="form-label">Pajak</label>
            <input type="text" name="pajak" class="form-control" placeholder="Pajak" value="{{ $sarpras->pajak }}" readonly>
    </div>
    <div class="container">
            <label class="form-label">Anggaran</label>
            <input type="text" name="anggaran" class="form-control" placeholder="Anggaran" value="{{ $sarpras->anggaran }}" readonly>
    </div>
    <div class="container">
            <label class="form-label">Total</label>
            <input type="text" name="total" class="form-control" placeholder="Total" value="{{ $sarpras->total }}" readonly>
    </div>
    <div class="container">
        <label class="form-label">Created At</label>
        <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $sarpras->created_at }}" readonly>
    </div>
    <div class="container">
        <label class="form-label">Updated At</label>
        <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $sarpras->updated_at }}" readonly>
    </div>
@endsection
