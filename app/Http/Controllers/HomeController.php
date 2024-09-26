<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pengajuan;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
}
