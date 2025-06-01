<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalRapat;
use App\Models\Konsumsi;
use App\Models\Sarpras;
use Illuminate\Support\Facades\DB;

class SarprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_jadwal = $request->id_jadwal;
        return view('sarpras.create', compact('id_jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id_jadwal = $request->query('id_jadwal'); // atau ->input()
        return view('sarpras.create', compact('id_jadwal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            // 'id_jadwal' => 'required|exists:jadwal,id',
            'nama_sarpras' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'pajak' => 'nullable|numeric|min:0',
            'anggaran' => 'required|numeric|min:0',
        ]);

        // Simpan ke session
        session(['form.sarpras' => [
            // 'id_jadwal' => $request->id_jadwal,
            'nama_sarpras' => $validated['nama_sarpras'],
            'jumlah' => $validated['jumlah'],
            'harga' => $validated['harga'],
            'pajak' => $validated['pajak'],
            'anggaran' => $validated['anggaran'],
        ]]);
        session()->save();
        // kembali ke form konsumsi
        return redirect()->route('submit.all'); //redirect ke penyimpanan db
    }
    public function submitAll()
    {
        if (empty(session('form'))) {
            return redirect()->route('rapat');
        }

        // Gunakan transaction, agar ketika ada error pada saat penyimpanan
        // data konsumsi/sarpras, maka penyimpanan data jadwal juga akan dibatalkan.
        DB::transaction(function () {
            $jadwalData = session('form.jadwal');
            $konsumsiData = session('form.konsumsi');
            $sarprasData = session('form.sarpras');

            // Simpan ke DB
            $jadwal = JadwalRapat::create($jadwalData);
            $konsumsiData['id_jadwal'] = $jadwal->id_jadwal;
            $sarprasData['id_jadwal'] = $jadwal->id_jadwal;

            // Nilai total akan di generate di oleh database (Virtual type)
            unset($konsumsiData['total']);
            unset($sarprasData['total']);

            //konsumsi
            Konsumsi::create($konsumsiData);
            Sarpras::create($sarprasData);

            // Kosongkan session
            session()->forget('form');
        });
        return redirect()->route('dashboard')->with('success', 'Data berhasil disimpan!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sarpras = Sarpras::findOrFail($id);

        return view('sarpras.show', compact('sarpras'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sarpras = Sarpras::findOrFail($id);

        return view('sarpras.edit', compact('sarpras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Cari data
        $sarpras = Sarpras::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama_sarpras' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'pajak' => 'nullable|numeric|min:0',
            'anggaran' => 'required|numeric|min:0',
            'tanggal_pengadaan' => 'required|date',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        // Update data ke database tanpa kolom 'total'
        $sarpras->nama_sarpras = $request->input('nama_sarpras');
        $sarpras->jumlah = $request->input('jumlah');
        $sarpras->harga = $request->input('harga');
        $sarpras->pajak = $request->input('pajak', 0);
        $sarpras->anggaran = $request->input('anggaran');
        $sarpras->tanggal_pengadaan = $request->input('tanggal_pengadaan');
        $sarpras->save();

        return redirect()->route('sarpras')->with('success', 'Data sarpras berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sarpras = Sarpras::findOrFail($id);

        $sarpras->delete();

        return redirect()->route('sarpras')->with('success', 'sarpras deleted successfully');
    }
}
