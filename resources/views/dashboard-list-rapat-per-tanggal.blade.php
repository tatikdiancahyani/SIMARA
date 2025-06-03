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
                <a href='#' class="btn btn-info">Download PDF</a>
                @if ( Auth::user()->role == 'admin')
                <button onclick="hapusRapat('{{ $rapat->id_jadwal }}')" class="btn-danger">Hapus</button>
                <button onclick="editRapat({{ json_encode($rapat) }})" class="btn-warning">Edit</button>
                @endif
            </td>
        </tr>
    </tfoot>
</table>
<hr>
@endforeach

@endif