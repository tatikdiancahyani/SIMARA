<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalRapat;
use App\Models\Konsumsi;
use App\Models\Sarpras;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SarprasController extends Controller
{

    public function create(Request $request)
    {
        $id_jadwal = $request->query('id_jadwal'); // atau ->input()
        return view('sarpras.create', compact('id_jadwal'));
    }

    public function submitAll(Request $request)
    {
        if (empty(session('form'))) {
            return redirect()->route('rapat');
        }

        // Validasi input
        $sarprasData = $request->validate([
            // 'id_jadwal' => 'required|exists:jadwal,id',
            'nama_sarpras' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'pajak' => 'nullable|numeric|min:0',
            'anggaran' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',

        ]);

        // Jika ada image diupload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imagePath = Storage::disk('public')->putFile('konsumsi', $file);
            $sarprasData['image_path'] = $imagePath;
        }

        // Gunakan transaction, agar ketika ada error pada saat penyimpanan
        // data konsumsi/sarpras, maka penyimpanan data jadwal juga akan dibatalkan.
        DB::transaction(function () use ($sarprasData) {
            $jadwalData = session('form.jadwal');
            $konsumsiData = session('form.konsumsi');

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
        return redirect()->route('home')->with('success', 'Data berhasil disimpan!');
    }
}
