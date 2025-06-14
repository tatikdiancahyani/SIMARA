@if($rapats->isEmpty())

<p>Tidak ada rapat</p>

@else

@foreach($rapats as $rapat)
<h2 style="text-align: center;">{{ $rapat->judul }}</h2>
<table style="width: 100%;">
    <thead>
        <tr>
            <th style="width: 25%;">Rapat</th>
            <th style="width: 25%;">Konsumsi</th>
            <th style="width: 25%;">Sarpras</th>
            <th style="width: 25%;">Notulen</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>
                    Judul: {{ $rapat->judul }}<br>
                    Tanggal: {{ $rapat->tanggal }}<br>
                    Waktu: {{ $rapat->waktu }}<br>
                    Tempat: {{ $rapat->tempat }}<br>
                    Deskripsi: {{ $rapat->deskripsi }}
                </p>
            </td>
            <td>
                <p>
                    Jenis Konsumsi: {{ $rapat->konsumsi->jenis_konsumsi }}<br />
                    Jumlah: {{ $rapat->konsumsi->jumlah }}<br />
                    Harga: {{ $rapat->konsumsi->harga }}<br />
                    Pajak: {{ $rapat->konsumsi->pajak }}<br />
                    Anggaran: {{ $rapat->konsumsi->anggaran }}<br />
                    Total: {{ $rapat->konsumsi->total }}<br />
                </p>
                @if ($rapat->konsumsi->image_path)
                    <img src="{{ Storage::url($rapat->konsumsi->image_path) }}" alt="Meeting Image" class="img-fluid clickable-image" style="max-width: 200px; padding: 15px">
                @endif
            </td>
            <td>
                <p>
                    Nama Sarpras: {{ $rapat->sarpras->nama_sarpras }}<br />
                    Jumlah: {{ $rapat->sarpras->jumlah }}<br />
                    Harga: {{ $rapat->sarpras->harga }}<br />
                    Pajak: {{ $rapat->sarpras->pajak }}<br />
                    Anggaran: {{ $rapat->sarpras->anggaran }}<br />
                    Total: {{ $rapat->sarpras->total }}<br />
                </p>
                @if ($rapat->sarpras->image_path)
                    <img src="{{ Storage::url($rapat->sarpras->image_path) }}" alt="Meeting Image" class="img-fluid clickable-image" style="max-width: 200px; padding: 15px">
                @endif
            </td>
            <td>
                @if ( $rapat->beritaAcara )
                Nama Rapat: {{ $rapat->beritaAcara->nama_rapat }}<br />
                Tanggal: {{ $rapat->beritaAcara->tanggal }}<br />
                Ruang: {{ $rapat->beritaAcara->ruang }}<br />
                Jumlah Peserta: {{ $rapat->beritaAcara->jumlah_peserta }}<br />
                Hasil Rapat: {{ $rapat->beritaAcara->hasil_rapat }}<br />
                @else
                <p>Belum ada</p>
                @endif
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">
                @if ( $rapat->beritaAcara )
                <a href="{{ route('berita.download', ['id' => $rapat->id_jadwal]) }}" class="btn btn-info">Download Berita Acara PDF</a>
                @endif
                @auth
                <button onclick="hapusRapat('{{ $rapat->id_jadwal }}')" class="btn-danger">Hapus</button>
                <button onclick="editRapat({{ json_encode($rapat) }})" class="btn-warning">Edit</button>
                @endauth
            </td>
        </tr>
    </tfoot>
</table>
<hr>
@endforeach

@endif