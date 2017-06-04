<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\barang;
use App\invoice;

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

    public function cek(Request $request)
    {
    	$barang = barang::all();
        $kodebarang = $request->input('kodebarang');
        $barangs = barang::where('kodebarang', $kodebarang)->first();
        if ($barangs!=null) {
        	return view('kasir/penjualan')->with('barangs', $barangs);
        }
        else {
        	$salah = 1;
        	return view('kasir/penjualan')->with('salah', $salah);
        }
    }

    public function jual(Request $request){
        $kodeinvoice = $request->input('kodeinvoice');
        $nama = $request->input('namacust');
        $tanggal = $request->input('tanggal');
        $kodebarang = $request->input('kodebarang');
        $jumlah = $request->input('jumlah');
        $invoice = new invoice;
        $invoice->kodeinvoice = $kodeinvoice;
        $invoice->nama = $nama;
        $invoice->tanggal = $tanggal;
        $invoice->kodebarang = $kodebarang;
        $invoice->jumlah = $jumlah;
        $invoice->save();
        
        return view('kasir/penjualan');
    }
}
