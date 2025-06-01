<?php

namespace App\Http\Controllers;

use App\Models\JadwalRapat;
use Illuminate\Http\Request;

class JadwalRapatController extends Controller
{
        public function rapat()
    {
        return view('rapat.jadwal-rapat'); 
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
        ]);

        // Simpan data jadwal rapat ke session, belum disimpan ke database
        session(['form.jadwal' => $validated]);
        
        session()->save();

        return redirect()->route('form.konsumsi');
    }
    public function storeJadwal(Request $request)
    {
        // validasi & session()->put(...)
        return redirect()->route('form.konsumsi');
    }
    public function index()
    {
        $jadwal = JadwalRapat::all(); // Ambil semua data jadwal rapat
        return response()->json($jadwal); // Kembalikan sebagai JSON
    }

}