<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::orderby('id','desc')->get();

        return view('barang.index', compact('barang'));
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
        request()->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required',
            'kondisi' => 'required',
        ]);
    
        Barang::create($request->all());
    
        return redirect()->route('barang.index')
                        ->with('success','Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        request()->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required',
            'kondisi' => 'required',
        ]);
    
        $barang->update($request->all());
    
        return redirect()->route('barang.index')
                        ->with('success','Barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
    
        return redirect()->route('barang.index')
                        ->with('success','Barang berhasil dihapus');
    }
}
