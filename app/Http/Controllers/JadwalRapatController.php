<?php

namespace App\Http\Controllers;

use App\Models\JadwalRapat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalRapatController extends Controller
{
    public function rapat(Request $request)
    {

        $selectedDate = $request->input('date');

        if (empty($selectedDate)) {
            $selectedDate = Carbon::today()->toDateString(); // YYYY-MM-DD format
        } else {
            // Ambil tanggal sesuai pilihan user
            $selectedDate = Carbon::parse($selectedDate)->toDateString();
        }
        $jadwalRapats = JadwalRapat::whereDate('tanggal', $selectedDate)
            ->with(['konsumsi', 'sarpras', 'beritaAcara'])
            ->orderBy('waktu')
            ->get();

        return view('rapat.jadwal-rapat', compact('jadwalRapats', 'selectedDate'));
    }

    public function create()
    {
        return view('rapat.jadwal-rapat');
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'tempat' => 'required|string|max:255',
            'deskripsi' => 'string',
        ]);

        // Simpan data jadwal rapat ke session, belum disimpan ke database
        session(['form.jadwal' => $validated]);

        session()->save();

        return redirect()->route('form.konsumsi');
    }


    public function update(Request $request, $id_jadwal)
    {

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'tempat' => 'required|string|max:255',
            'deskripsi' => 'string'
        ]);

        $jadwalRapat = JadwalRapat::findOrFail($id_jadwal);
        $jadwalRapat->update($validated);

        return response()->json(['status' => 'OK']);
    }

    public function destroy($id_jadwal)
    {
        $jadwalRapat = JadwalRapat::with(['beritaAcara'])->findOrFail($id_jadwal);
        $jadwalRapat->konsumsi()->delete();
        $jadwalRapat->sarpras()->delete();

        if ($jadwalRapat->beritaAcara) {
            $jadwalRapat->beritaAcara->delete();
        }
        $jadwalRapat->delete();
        return response()->json(['status' => 'OK']);
    }

    public function storeJadwal(Request $request)
    {
        // validasi & session()->put(...)
        return redirect()->route('form.konsumsi');
    }
    public function index()
    {
        $jadwal = JadwalRapat::get(); // Ambil semua data jadwal rapat
        return response()->json($jadwal); // Kembalikan sebagai JSON
    }

    public function listRapatPerTanggal($tanggal)
    {
        $selectedDate = Carbon::parse($tanggal)->toDateString();
        $rapats = JadwalRapat::whereDate('tanggal', $selectedDate)
            ->with(['konsumsi', 'sarpras', 'beritaAcara'])
            ->orderBy('waktu')
            ->get();

        return view('dashboard-list-rapat-per-tanggal', compact('rapats', 'tanggal'));
    }
}
