<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    /**
     * Menampilkan daftar pengajuan peminjaman yang dilakukan user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mendapatkan semua pengajuan yang dilakukan oleh user yang sedang login
        $pengajuans = Pengajuan::where('user_id', Auth::id())->with('barang')->get();

        // Return view dengan data pengajuan
        return view('peminjaman.index', compact('pengajuans'));
    }
    
    /**
     * Menampilkan form pengajuan peminjaman barang.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mendapatkan semua barang yang tersedia untuk dipinjam
        $barangs = Barang::all();

        // Return view dengan form pengajuan peminjaman
        return view('peminjaman.create', compact('barangs'));
    }

    /**
     * Menyimpan data pengajuan peminjaman barang.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tanggal_pengajuan' => 'required|date',
        ]);

        // Simpan data pengajuan ke database
        Pengajuan::create([
            'user_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'status' => 'pending',
        ]);

        // Redirect ke halaman lain dengan pesan sukses
        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan peminjaman berhasil dibuat.');
    }
}
