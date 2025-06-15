<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsumsi;
use Illuminate\Support\Facades\Storage;

class KonsumsiController extends Controller
{
    public function create(Request $request)
    {
        return view('konsumsi.form');
    }

    public function store(Request $request)
    {
        // Validasi input
        $konsumsiData = $request->validate([
            'jenis_konsumsi' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'pajak' => 'nullable|string',
            'anggaran' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Simpan ke session
        session()->put('form.konsumsi', [
            'jenis_konsumsi' => $konsumsiData['jenis_konsumsi'],
            'jumlah' => $konsumsiData['jumlah'],
            'harga' => $konsumsiData['harga'],
            'pajak' => $konsumsiData['pajak'],
            'anggaran' => $konsumsiData['anggaran'],
        ]);

        // Jika ada image diupload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imagePath = Storage::disk('public')->putFile('konsumsi', $file);
            session()->put('form.konsumsi.image_path', $imagePath);
        }

        session()->save();

        // Setelah simpan, redirect ke form sarpras
        return redirect()->route('form.sarpras');
    }
}
