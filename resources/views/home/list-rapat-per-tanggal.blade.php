@if($rapats->isEmpty())
    <p style="text-align: center;">Tidak ada rapat</p>
@else
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <thead>
            <tr style="background-color: #6610f2; color: white;">
                <th style="padding: 10px; border: 1px solid #dee2e6;">Rapat</th>
                
                @auth
                    @if(auth()->user()->role === 'admin')
                        <th style="padding: 10px; border: 1px solid #dee2e6;">Konsumsi</th>
                        <th style="padding: 10px; border: 1px solid #dee2e6;">Sarpras</th>
                        <th style="padding: 10px; border: 1px solid #dee2e6;">Berita Acara</th>
                        <th style="padding: 10px; border: 1px solid #dee2e6;">Aksi</th>
                    @endif
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach($rapats as $rapat)
                <tr>
                    {{-- Kolom Rapat --}}
                    <td style="padding: 10px; border: 1px solid #dee2e6;">
                        <div><strong>Judul:</strong> {{ $rapat->judul }}</div>
                        <div><strong>Tanggal:</strong> {{ $rapat->tanggal }}</div>
                        <div><strong>Waktu:</strong> {{ $rapat->waktu }}</div>
                        <div><strong>Tempat:</strong> {{ $rapat->tempat }}</div>
                        <div><strong>Deskripsi:</strong> {{ $rapat->deskripsi }}</div>
                    </td>

                    {{-- Kolom Konsumsi --}}
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <td style="padding: 10px; border: 1px solid #dee2e6;">
                                <div><strong>Jenis:</strong> {{ $rapat->konsumsi->jenis_konsumsi ?? '-' }}</div>
                                <div><strong>Jumlah:</strong> {{ $rapat->konsumsi->jumlah ?? '-' }}</div>
                                <div><strong>Harga:</strong> Rp{{ number_format($rapat->konsumsi->harga ?? 0) }}</div>
                                <div><strong>Pajak:</strong> Rp{{ number_format($rapat->konsumsi->pajak ?? 0) }}</div>
                                <div><strong>Anggaran:</strong> Rp{{ number_format($rapat->konsumsi->anggaran ?? 0) }}</div>
                                <div><strong>Total:</strong> Rp{{ number_format($rapat->konsumsi->total ?? 0) }}</div>
                                @if ($rapat->konsumsi && $rapat->konsumsi->image_path)
                                    <img src="{{ Storage::url($rapat->konsumsi->image_path) }}" alt="Konsumsi" style="max-width: 100px; margin-top: 10px;">
                                @endif
                            </td>
                        @endif
                    @endauth

                    {{-- Kolom Sarpras --}}
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <td style="padding: 10px; border: 1px solid #dee2e6;">
                                <div><strong>Nama:</strong> {{ $rapat->sarpras->nama_sarpras ?? '-' }}</div>
                                <div><strong>Jumlah:</strong> {{ $rapat->sarpras->jumlah ?? '-' }}</div>
                                <div><strong>Harga:</strong> Rp{{ number_format($rapat->sarpras->harga ?? 0) }}</div>
                                <div><strong>Pajak:</strong> Rp{{ number_format($rapat->sarpras->pajak ?? 0) }}</div>
                                <div><strong>Anggaran:</strong> Rp{{ number_format($rapat->sarpras->anggaran ?? 0) }}</div>
                                <div><strong>Total:</strong> Rp{{ number_format($rapat->sarpras->total ?? 0) }}</div>
                                @if ($rapat->sarpras && $rapat->sarpras->image_path)
                                    <img src="{{ Storage::url($rapat->sarpras->image_path) }}" alt="Sarpras" style="max-width: 100px; margin-top: 10px;">
                                @endif
                            </td>
                        @endif
                    @endauth

                    {{-- Kolom Berita Acara --}}
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <td style="padding: 10px; border: 1px solid #dee2e6;">
                                @if ($rapat->beritaAcara)
                                    <div><strong>Nama:</strong> {{ $rapat->beritaAcara->nama_rapat }}</div>
                                    <div><strong>Tanggal:</strong> {{ $rapat->beritaAcara->tanggal }}</div>
                                    <div><strong>Ruang:</strong> {{ $rapat->beritaAcara->ruang }}</div>
                                    <div><strong>Peserta:</strong> {{ $rapat->beritaAcara->jumlah_peserta }}</div>
                                    <div><strong>Hasil:</strong> {{ $rapat->beritaAcara->hasil_rapat }}</div>
                                    <a href="{{ route('berita.download', ['id' => $rapat->id_jadwal]) }}" class="btn btn-sm btn-info mt-2">Download PDF</a>
                                @else
                                    <em>Belum ada</em>
                                @endif
                            </td>
                        @endif
                    @endauth

                    {{-- Kolom Aksi --}}
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <td style="padding: 10px; border: 1px solid #dee2e6; text-align: center;">
                                <button onclick="hapusRapat('{{ $rapat->id_jadwal }}')" class="btn btn-sm btn-danger mb-1">Hapus</button><br>
                                <button onclick="editRapat({{ json_encode($rapat) }})" class="btn btn-sm btn-warning mt-1">Edit</button>
                            </td>
                        @endif
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
