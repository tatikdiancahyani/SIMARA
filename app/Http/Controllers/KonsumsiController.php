<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsumsi;
use Illuminate\Support\Facades\Storage;

class KonsumsiController extends Controller
{
    public function create(Request $request)
    {
        $konsumsi = session('form.konsumsi',[]);
        return view('konsumsi.form', compact('konsumsi'));
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
            $konsumsiData['image_path'] = $imagePath;
            session()->put('form.konsumsi.image_path', $imagePath);
        }

        if( $request->input('id_konsumsi') ){
            // update ke database
            $id = $request->input('id_konsumsi');
            
            $konsumsi = Konsumsi::findOrFail($id);
            $konsumsi->update($konsumsiData);
            return redirect()->route('home');
        }else{
            // Next ke sarpras
            session()->save();
            // Setelah simpan, redirect ke form sarpras
            return redirect()->route('form.sarpras');
        }

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $konsumsi = Konsumsi::findOrFail($id);

        return view('konsumsi.form', compact('konsumsi'));
    }
}
