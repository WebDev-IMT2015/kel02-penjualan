<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Incomingproduk;
use App\Produk;
use Illuminate\Http\Request;
use Session;

class IncomingprodukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $incomingproduk = Incomingproduk::where('kode', 'LIKE', "%$keyword%")
            ->orWhere('jumlah', 'LIKE', "%$keyword%")
            ->orWhere('keterangan', 'LIKE', "%$keyword%")
            ->paginate($perPage);
        } else {
            $incomingproduk = Incomingproduk::paginate($perPage);
        }

        return view('gudang.incomingproduk.index', compact('incomingproduk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('gudang.incomingproduk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $produk = Produk::all();
        $kodebarang = $request->input('kode');
        $produks = Produk::where('kode', $kodebarang)->first();
        if ($produks!=null && $request->jumlah>0) {
            //tambah stock
            $produks->jumlah = $produks->jumlah + $request->input('jumlah');
            $produks->save();

            //input ke incomingproduk
            $requestData = $request->all();

            Incomingproduk::create($requestData);
            Session::flash('flash_message', 'Incomingproduk added!');

            $sukses = "Sukses menambah barang".$request->input('kode');

            return redirect('gudang/incomingproduk')->with('sukses', $sukses);
        } elseif ($produks==null && $request->jumlah>0){
            $salah1 = "Kode barang tidak ditemukan.";
            return redirect('gudang/incomingproduk/create')->with('salah1', $salah1);
        } elseif ($produks!=null && $request->jumlah<=0){
            $salah1 = "Jumlah barang yang diinputkan negatif atau 0. Mohon memasukkan jumlah barang masuk positif.";
            return redirect('gudang/incomingproduk/create')->with('salah1', $salah1);
        } else {
            $salah1 = "Kode barang tidak ditemukan.";
            $salah2 = "Jumlah barang yang diinputkan negatif atau 0. Mohon memasukkan jumlah barang masuk positif.";
            return redirect('gudang/incomingproduk/create')->with('salah1', $salah1)->with('salah2', $salah2);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $incomingproduk = Incomingproduk::findOrFail($id);

        return view('gudang.incomingproduk.show', compact('incomingproduk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $incomingproduk = Incomingproduk::findOrFail($id);

        return view('gudang.incomingproduk.edit', compact('incomingproduk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $requestData = $request->all();
        
        $incomingproduk = Incomingproduk::findOrFail($id);
        $incomingproduk->update($requestData);

        Session::flash('flash_message', 'Incomingproduk updated!');

        return redirect('gudang/incomingproduk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Incomingproduk::destroy($id);

        Session::flash('flash_message', 'Incomingproduk deleted!');

        return redirect('gudang/incomingproduk');
    }
}
