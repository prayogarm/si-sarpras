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
        $pengajuan = Pengajuan::with(['user', 'barang'])->orderBy('created_at', 'desc')->get();
                                    
        // Return view dengan data peminjaman
        return view('admin.peminjaman', compact('pengajuan'));
    }

    /**
     * Tampilkan semua data peminjaman barang habis pakai oleh user.
     *
     * @return \Illuminate\Http\Response
     */
    public function peminjamanhp(){
        $peminjamanhp = Pengajuan::with(['user', 'barang'])->whereHas('barang', function ($query) {
                                        $query->where('kategori', 'Habis Pakai');
                                    })->orderBy('created_at', 'desc')
                                    ->get();

        return view('admin.peminjamanhp', compact('peminjamanhp'));   
    }

    /**
     * Tampilkan semua data peminjaman barang habis pakai oleh user.
     *
     * @return \Illuminate\Http\Response
     */
    public function peminjamanthp(){
        $peminjamanthp = Pengajuan::with(['user', 'barang'])->whereHas('barang', function ($query) {
                                        $query->where('kategori', 'Tidak Habis Pakai');
                                    })->orderBy('created_at', 'desc')
                                    ->get();

        return view('admin.peminjamanthp', compact('peminjamanthp'));   
    }

    /**
     * Tampilkan semua data pengembalian oleh user.
     *
     * @return \Illuminate\Http\Response
     */
    public function pengembalian()
    {
        // Mendapatkan semua data pengembalian dengan relasi user, barang, dan pengajuan
        $pengembalian = Pengembalian::with(['user', 'barang', 'pengajuan'])->orderBy('created_at', 'desc')->get();

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

    public function approvepengembalian($id)
    {
        // Cari pengembalian berdasarkan id
        $pengembalian = Pengembalian::findOrFail($id);

        // Set status menjadi approved
        $pengembalian->status = 'approved';
        $pengembalian->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.pengembalian')->with('success', 'Pengembalian telah disetujui.');
    }

    public function rejectpengembalian($id)
    {
        // Cari pengembalian berdasarkan id
        $pengembalian = Pengembalian::findOrFail($id);

        // Set status menjadi rejected
        $pengembalian->status = 'rejected';
        $pengembalian->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.pengembalian')->with('success', 'Pengembalian telah ditolak.');
    }

    public function hapuspengajuan($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->delete();
    
        return redirect()->route('admin.peminjaman')->with('success','Data berhasil dihapus');
    }

    public function hapuspengembalian($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();
    
        return redirect()->route('admin.pengembalian')->with('success','Data berhasil dihapus');
    }
}
