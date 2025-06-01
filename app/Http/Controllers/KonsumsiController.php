<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Konsumsi;
 
class KonsumsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $konsumsi = Konsumsi::orderBy('created_at', 'DESC')->get();
  
        return view('konsumsis.index', compact('konsumsi'));
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id_jadwal = $request->query('id_jadwal'); // atau ->input()
        return view('konsumsis.create', compact('id_jadwal'));
    }
    
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $konsumsiData = $request->validate([
            'jenis_konsumsi' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'pajak' => 'nullable|string',
            'anggaran' => 'required|numeric|min:0',
        ]);

        // Simpan ke session
        session()->put('form.konsumsi', [
            'jenis_konsumsi' => $konsumsiData['jenis_konsumsi'],
            'jumlah' => $konsumsiData['jumlah'],
            'harga' => $konsumsiData['harga'],
            'pajak' => $konsumsiData['pajak'],
            'anggaran' => $konsumsiData['anggaran'],
        ]);

        session()->save();

         // Setelah simpan, redirect ke form sarpras
        return redirect()->route('form.sarpras', ['id_jadwal' => $request->id_jadwal])
        ->with('form_sarpras', true);
    }


  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $konsumsi = Konsumsi::findOrFail($id);
  
        return view('konsumsis.show', compact('konsumsi'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $konsumsi = Konsumsi::findOrFail($id);
  
        return view('konsumsis.edit', compact('konsumsi'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Cari data
        $konsumsi = Konsumsi::findOrFail($id);

        // Validasi input
        $request->validate([
            'jenis_konsumsi' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'pajak' => 'nullable|numeric|min:0',
            'anggaran' => 'required|numeric|min:0',
            'tanggal_pengadaan' => 'required|date',
        ]);

        // Update data ke database tanpa kolom 'total'
        $konsumsi->jenis_konsumsi = $request->input('jenis_konsumsi');
        $konsumsi->jumlah = $request->input('jumlah');
        $konsumsi->harga = $request->input('harga');
        $konsumsi->pajak = $request->input('pajak', 0);
        $konsumsi->anggaran = $request->input('anggaran');
        $konsumsi->tanggal_pengadaan = $request->input('tanggal_pengadaan');
        $konsumsi->save();

        return redirect()->route('konsumsis')->with('success', 'Data konsumsi berhasil diupdate!');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $konsumsi = Konsumsi::findOrFail($id);
  
        $konsumsi->delete();
  
        return redirect()->route('konsumsis')->with('success', 'konsumsis deleted successfully');
    }
}