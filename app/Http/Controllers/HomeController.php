<?php

namespace App\Http\Controllers;

use App\Models\JadwalRapat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index'); // Menampilkan view 'home.blade.php'
    }

    public function listJadwal(){
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

        return view('home.list-rapat-per-tanggal', compact('rapats', 'tanggal'));
    }

     public function login()
    {
        return view('home.login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
}