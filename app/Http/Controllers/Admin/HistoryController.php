<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use App\History;
use App\Invoice;
use App\Produk;
use Illuminate\Http\Request;
use Session;

class HistoryController extends Controller
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
            $history = Invoice::where('customer', 'LIKE', "%$keyword%")
				->orWhere('tanggal', 'LIKE', "%$keyword%")
				->orWhere('belanjaan', 'LIKE', "%$keyword%")
				->orWhere('jumlah', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $history = Invoice::paginate($perPage);
        }

        return view('admin.history.index', compact('history'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.history.create');
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
        
        // $requestData = $request->all();
        
        // History::create($requestData);

        // Session::flash('flash_message', 'History added!');

        // return redirect('admin/history');
        $namaprodukinput = $request->input('belanjaan');
        $produks = Produk::where('kode', $namaprodukinput)->first();
        if ($produks!=null) {
            // return view('kasir/penjualan')->with('barangs', $barangs);
            $requestData = $request->all();
            
            Invoice::create($requestData);

            Session::flash('flash_message', 'Invoice added!');

            return redirect('admin/history');
        }
        else {
            $salah1 = "Barang tidak ditemukan.";
            return redirect('admin/history/create')->with('salah1', $salah1);
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
        $history = Invoice::findOrFail($id);

        return view('admin.history.show', compact('history'));
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
        $history = Invoice::findOrFail($id);

        return view('admin.history.edit', compact('history'));
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
        
        $history = Invoice::findOrFail($id);
        $history->update($requestData);

        Session::flash('flash_message', 'History updated!');

        return redirect('admin/history');
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
        Invoice::destroy($id);

        Session::flash('flash_message', 'History deleted!');

        return redirect('admin/history');
    }
}
