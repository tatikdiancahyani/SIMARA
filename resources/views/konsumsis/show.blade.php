@extends('layouts.app')

@section('contents')
    <style>
    </style>
    <h1 class="mb-0">Detail Konsumsi</h1>
    <hr />
    <div class="container">
            <label class="form-label">Jenis Konsumsi</label>
            <input type="text" name="jenis_konsumsi" class="form-control" placeholder="Jenis Konsumsi" value="{{ $konsumsi->jenis_konsumsi }}" readonly>
    </div>
    <div class="container">
            <label class="form-label">Tanggal</label>
            <input type="text" name="tanggal_pengadaan" class="form-control" placeholder="Tanggal" value="{{ $konsumsi->tanggal_pengadaan }}" readonly>
    </div>
    <div class="container">
            <label class="form-label">Jumlah</label>
            <input type="text" name="jumlah" class="form-control" placeholder="Jumlah" value="{{ $konsumsi->jumlah }}" readonly>
    </div>
    <div class="container">
            <label class="form-label">Harga</label>
            <input type="text" name="harga" class="form-control" placeholder="Harga" value="{{ $konsumsi->harga }}" readonly>
    </div>
    <div class="container">
            <label class="form-label">Pajak</label>
            <input type="text" name="pajak" class="form-control" placeholder="Pajak" value="{{ $konsumsi->pajak }}" readonly>
    </div>
    <div class="container">
            <label class="form-label">Anggaran</label>
            <input type="text" name="anggaran" class="form-control" placeholder="Anggaran" value="{{ $konsumsi->anggaran }}" readonly>
    </div>
    <div class="container">
            <label class="form-label">Total</label>
            <input type="text" name="total" class="form-control" placeholder="Total" value="{{ $konsumsi->total }}" readonly>
    </div>
    <div class="container">
        <label class="form-label">Created At</label>
        <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $konsumsi->created_at }}" readonly>
    </div>
    <div class="container">
        <label class="form-label">Updated At</label>
        <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $konsumsi->updated_at }}" readonly>
    </div>
@endsection
