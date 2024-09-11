<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class PengajuannController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan semua pengajuan yang dilakukan oleh user yang sedang login
        $pengajuans = Pengajuan::where('user_id', Auth::id())->with('barang')->get();
        $barangs = Barang::all();

        // Return view dengan data pengajuan
        return view('peminjaman', compact('pengajuans', 'barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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
        return redirect()->route('pengajuann.index')->with('success', 'Pengajuan peminjaman berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
