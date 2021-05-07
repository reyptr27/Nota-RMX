<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all();
        return view('jualanku.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);

        $request->validate([
            'spg' => 'required|min:3|max:30',
            'nama' => 'required|min:3|max:30',
            'hp' => 'required|numeric|digits_between:10,15',
            'alamat' => 'required|max:255|min:3',
            'ongkir' => 'required|numeric|digits_between:4,6',
            'orderProducts.*.product_id' => 'required|numeric',
            'orderProducts.*.quantity' => 'required|numeric|min:1'
        ], [
            'spg.required' => 'Harus diisi !',
            'spg.min' => 'Minimal 3 karakter !',
            'spg.max' => 'Maximal 30 karakter !',
            'nama.required' => 'Harus diisi !',
            'nama.min' => 'Minimal 3 karakter !',
            'nama.max' => 'Maximal 30 karakter !',
            'hp.required' => 'Harus diisi !',
            'hp.numeric' => 'Harus diisi dengan angka !',
            'hp.digits_between' => 'Minimal 10 digit & maximal 15 digit !',
            'alamat.required' => 'Harus diisi !',
            'alamat.min' => 'Minimal 3 karakter !',
            'alamat.max' => 'Maximal 255 karakter !',
            'ongkir.required' => 'Harus diisi !',
            'ongkir.numeric' => 'Harus diisi dengan angka !',
            'ongkir.digits_between' => 'Minimal 4 digit & maximal 6 digit !',
            'orderProducts.*.product_id.required' => 'Tentukan produk yang dipesan !',
            'orderProducts.*.quantity.required' => 'Tentukan kuantitas !',
            'orderProducts.*.quantity.numeric' => 'Harus bernilai angka !',
            'orderProducts.*.quantity.min' => 'Pemesanan minimal 1 !',
        ]);

        $current_timestamp = Carbon::now()->timestamp;
        $invoice = 'INV'.$request->hp.$current_timestamp;
        // dd($current_timestamp);
       
        $order = Order::create([
            'no' => $invoice,
            'spg' => $request->spg,
            'nama' => $request->nama,
            'hp' => $request->hp,
            'alamat' => $request->alamat,
            'ongkir' => $request->ongkir,
        ]);  

        foreach ($request->orderProducts as $product) {
            $order->products()->attach($product['product_id'],
                ['quantity' => $product['quantity']]);
        }

        //dd($invoice);
        return redirect()->route('show', $invoice);
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($invoice)
    {
        //dd($invoice);
        return view('jualanku.show', ['invoice' => $invoice]);
    }
    
    /**
     * Display a listing of the resource.
     * Custom show 
     * 
     * @return \Illuminate\Http\Response
     */
    public function order($id)
    {
        //dd($invoice);
        //column name
        $column = 'no';
        
        $data = Order::where($column, '=', $id)->get();
        
        //cari order_id 
        $idp = $data->pluck('id')->toArray();
        $orderid = OrderProduct::where('order_id', '=', $idp)->get();
        //dd($orderid);

        //cari produk id berdasarkan produk id di order produk
        $productid = $orderid->pluck('product_id')->toArray();
        //dd($productid);
        //produk
        $pesanan =  DB::table('products')->whereIn('id', $productid)->get();
        //dd($pesanan);
        
        //kuantitas
        $qty = OrderProduct::where('order_id', '=', $idp)->pluck('quantity');
        //dd($qty);

        //ambil harga produk untuk ditotal
        $harga = $pesanan->pluck('harga')->toArray(); 
        //ambil jumlah produk untuk ditotal
        $jumlah = $qty->toArray();
        //ambil harga ongkir untuk ditotal
        $hargaongkir = $data->pluck('ongkir')->toArray(); 
        $ongkir = implode($hargaongkir);
        $intongkir = (int)$ongkir;
        //dd($intongkir);
      
        // $arr1 = [0 => 1, 1 => 2];
        // $arr2 = [0 => 100000, 1 => 90000];
        foreach ($harga as $k => $val) {
            $total[$k]=$val * $jumlah[$k];
        }
        //harga total belum ongkir
        $totalsum=(array_sum($total));
        //total plus ongkir
        $totalfix = $totalsum + $intongkir;
        //dd($totalfix);

        return view('jualanku.invoice')->with('data', $data)->with('qty', $qty)->with('pesanan', $pesanan)->with('totalfix', $totalfix);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show the thank you page.
     *
     * @return \Illuminate\Http\Response
     */
    public function terimakasih()
    {
        return view('jualanku.thankyou');
    }

}
