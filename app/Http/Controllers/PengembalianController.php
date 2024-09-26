<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajuans = Pengajuan::where('user_id', Auth::id())
                                ->where('status', 'approved')
                                ->with('barang')
                                ->get();
        // Mendapatkan semua pengembalian yang dilakukan oleh user yang sedang login
        $pengembalians = Pengembalian::where('user_id', Auth::id())
                                        ->with('barang', 'pengajuan')
                                        ->orderBy('created_at', 'desc')
                                        ->get();

        // Return view dengan data pengembalian
        return view('pengembalian', compact('pengembalians','pengajuans'));
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
            'pengajuan_id' => 'required|exists:pengajuans,id',
            'tanggal_pengembalian' => 'required|date',
        ]);

        // Simpan data pengembalian ke database
        Pengembalian::create([
            'user_id' => Auth::id(),
            'pengajuan_id' => $request->pengajuan_id,
            'barang_id' => Pengajuan::find($request->pengajuan_id)->barang_id,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status' => 'pending',
        ]);

        // Redirect ke halaman lain dengan pesan sukses
        return redirect()->route('pengembalian.index')->with('success', 'Pengajuan pengembalian berhasil dibuat.');
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
