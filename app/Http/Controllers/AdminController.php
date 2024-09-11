<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Pengembalian;

class AdminController extends Controller
{
    /**
     * Tampilkan semua data peminjaman oleh user.
     *
     * @return \Illuminate\Http\Response
     */
    public function peminjaman()
    {
        // Mendapatkan semua data peminjaman dengan relasi user dan barang
        $pengajuan = Pengajuan::with(['user', 'barang'])->get();

        // Return view dengan data peminjaman
        return view('admin.peminjaman', compact('pengajuan'));
    }

    /**
     * Tampilkan semua data pengembalian oleh user.
     *
     * @return \Illuminate\Http\Response
     */
    public function pengembalian()
    {
        // Mendapatkan semua data pengembalian dengan relasi user, barang, dan pengajuan
        $pengembalian = Pengembalian::with(['user', 'barang', 'pengajuan'])->get();

        // Return view dengan data pengembalian
        return view('admin.pengembalian', compact('pengembalian'));
    }

    public function approve($id)
    {
        // Cari pengajuan berdasarkan id
        $pengajuan = Pengajuan::findOrFail($id);

        // Set status menjadi approved
        $pengajuan->status = 'approved';
        $pengajuan->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.peminjaman')->with('success', 'Pengajuan telah disetujui.');
    }

    public function reject($id)
    {
        // Cari pengajuan berdasarkan id
        $pengajuan = Pengajuan::findOrFail($id);

        // Set status menjadi rejected
        $pengajuan->status = 'rejected';
        $pengajuan->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.peminjaman')->with('success', 'Pengajuan telah ditolak.');
    }
}
