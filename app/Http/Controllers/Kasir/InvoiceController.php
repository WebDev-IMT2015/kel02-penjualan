<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Invoice;
use App\Produk;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use Session;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
     
     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $invoice = Invoice::where('customer', 'LIKE', "%$keyword%")
				->orWhere('tanggal', 'LIKE', "%$keyword%")
				->orWhere('belanjaan', 'LIKE', "%$keyword%")
				->orWhere('jumlah', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $invoice = Invoice::paginate($perPage);
        }

        return view('kasir.invoice.index', compact('invoice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $products = Produk::all();
        return view('kasir.invoice.invoicedesperate')->with('products', $products);
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
        // $namaprodukinput = $request->input('belanjaan');
        // $produks = Produk::where('kode', $namaprodukinput)->first();
        // if ($produks!=null) {

        //     $requestData = $request->all();

        //     Invoice::create($requestData);

        //     Session::flash('flash_message', 'Invoice added!');

        //     return redirect('kasir/invoice');
        // }
        // else {
        //     $salah1 = "Barang tidak ditemukan.";
        //     return redirect('kasir/invoice/create')->with('salah1', $salah1);
        // }
        $namaprodukinput = $request->input('belanjaan');
        $produks = Produk::where('kode', $namaprodukinput)->first();
        if ($produks!=null) {
            // return view('kasir/penjualan')->with('barangs', $barangs);
            $requestData = $request->all();

            Invoice::create($requestData);

            Session::flash('flash_message', 'Invoice added!');

            return redirect('kasir/invoice');
        }
        else {
            $salah1 = "Barang tidak ditemukan.";
            return redirect('kasir/invoice/create')->with('salah1', $salah1);
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
        $invoice = Invoice::findOrFail($id);

        return view('kasir.invoice.show', compact('invoice'));
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
        $invoice = Invoice::findOrFail($id);

        return view('kasir.invoice.edit', compact('invoice'));
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

        $invoice = Invoice::findOrFail($id);
        $invoice->update($requestData);

        Session::flash('flash_message', 'Invoice updated!');

        return redirect('kasir/invoice');
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

        Session::flash('flash_message', 'Invoice deleted!');

        return redirect('kasir/invoice');
    }
}
