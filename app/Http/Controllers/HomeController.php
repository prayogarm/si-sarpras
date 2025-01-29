<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pengajuan;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $barang = Barang::count();
        $peminjaman = Pengajuan::count();
        $pengembalian = Pengembalian::count();
        $pengguna = User::count();

        return view('home', compact('barang','peminjaman','pengembalian','pengguna'));
    }

    public function profile(){
        return view('profile');
    }

    public function riwayat(){
        $pengajuan = Pengajuan::where('user_id', Auth::id())
                                ->where('status', 'selesai')
                                ->with('barang')
                                ->get();
        // Mendapatkan semua pengembalian yang dilakukan oleh user yang sedang login
        $pengembalian = Pengembalian::where('user_id', Auth::id())
                                        ->with('barang', 'pengajuan')
                                        ->where('status', 'selesai')
                                        ->orderBy('created_at', 'desc')
                                        ->get();

        // Return view dengan data pengembalian
        return view('riwayat', compact('pengembalian','pengajuan'));
    }
}
