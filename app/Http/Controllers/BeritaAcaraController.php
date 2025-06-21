<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\JadwalRapat;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BeritaAcaraController extends Controller
{
    public function index(Request $request)
    {

        $selectedDate = $request->input('date');

        if (empty($selectedDate)) {
            $selectedDate = Carbon::today()->toDateString(); // YYYY-MM-DD format
        } else {
            // Ambil tanggal sesuai pilihan user
            $selectedDate = Carbon::parse($selectedDate)->toDateString();
        }
        $beritaAcara = BeritaAcara::whereDate('tanggal', $selectedDate)
            ->orderBy('id_berita_acara')
            ->get();

        return view('berita-acara.index', compact('beritaAcara', 'selectedDate')); // Kirim $beritaAcara ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|integer',
            'nama_rapat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'ruang' => 'required|string|max:255',
            'jumlah_peserta' => 'required|integer',
            'hasil_rapat' => 'required|string|max:255',
        ]);

        $jadwalRapat = JadwalRapat::findOrFail($request->id_jadwal);

        // Cek apakah sudah pernah di input?
        if ($jadwalRapat->beritaAcara()->exists()) {
            // update
            $jadwalRapat->beritaAcara->nama_rapat = $request->nama_rapat;
            $jadwalRapat->beritaAcara->tanggal = $request->tanggal;
            $jadwalRapat->beritaAcara->ruang = $request->ruang;
            $jadwalRapat->beritaAcara->jumlah_peserta = $request->jumlah_peserta;
            $jadwalRapat->beritaAcara->hasil_rapat = $request->hasil_rapat;
            $jadwalRapat->beritaAcara->save();
        } else {
            BeritaAcara::create([
                'id_jadwal' => $request->id_jadwal,
                'nama_rapat' => $request->nama_rapat,
                'tanggal' => $request->tanggal,
                'ruang' => $request->ruang,
                'jumlah_peserta' => $request->jumlah_peserta,
                'hasil_rapat' => $request->hasil_rapat,
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil disimpan.');
    }


    public function downloadPDF($id_jadwal)
    {
        $rapat = JadwalRapat::with(['konsumsi', 'sarpras', 'beritaAcara'])->findOrFail($id_jadwal);
        $berita = $rapat->beritaAcara;
        $konsumsi = $rapat->konsumsi;
        $sarpras = $rapat->sarpras;

        $pdf = PDF::loadView('berita-acara.pdf', [
            'rapat' => $rapat,
            'konsumsi' => $konsumsi,
            'sarpras' => $sarpras,
            // Berita Acara
            'tanggal' => $berita->tanggal,
            'ruang' => $berita->ruang,
            'nama_rapat' => $berita->nama_rapat,
            'jumlah_peserta' => $berita->jumlah_peserta,
            'hasil_rapat' => $berita->hasil_rapat,
        ]);
        return $pdf->download('berita_acara_' . $berita->id_berita_acara . '.pdf');
    }
}
