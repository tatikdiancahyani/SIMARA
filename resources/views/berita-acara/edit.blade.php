@extends('layouts.app')

@section('title', 'Edit Berita Acara')

@section('contents')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Berita Acara</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('berita-acara.update', ['id' => $beritaAcara->id_input]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama_rapat">Nama Rapat</label>
                            <input type="text" id="nama_rapat" name="nama_rapat" class="form-control" value="{{ $beritaAcara->nama_rapat }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ $beritaAcara->tanggal }}" required>
                        </div>

                        <div class="form-group">
                            <label for="ruang">Ruang</label>
                            <input type="text" id="ruang" name="ruang" class="form-control" value="{{ $beritaAcara->ruang }}" required>
                        </div>

                        <div class="form-group">
                            <label for="jumlah_peserta">Jumlah Peserta</label>
                            <input type="number" id="jumlah_peserta" name="jumlah_peserta" class="form-control" value="{{ $beritaAcara->jumlah_peserta }}" required>
                        </div>

                        <div class="form-group">
                            <label for="hasil_rapat">Hasil Rapat</label>
                            <textarea id="hasil_rapat" name="hasil_rapat" class="form-control" rows="5" required>{{ $beritaAcara->hasil_rapat }}</textarea>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            <a href="{{ route('berita') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
