<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\barang;

class barangController extends Controller
{
    public function index()
    {        
        $barang = barang::all();
        return view('inputbarang')->with('barang', $barang);
    }


public function store(Request $request)
    {
        $kodebarang = $request->input('kodebarang');
        $nama = $request->input('nama');
        $jumlah = $request->input('jumlah');
        $harga = $request->input('harga');
        $barang = new barang;
        $barang->kodebarang = $kodebarang;
        $barang->nama = $nama;
        $barang->jumlah = $jumlah;
        $barang->harga = $harga;
        $barang->save();
        
        return redirect('inputbarang');
    }
}
