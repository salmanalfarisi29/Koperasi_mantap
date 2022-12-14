<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use exception;

class ProductController extends Controller
{
  // public function __construct()
  // {
  //   $this->middleware(['role:admin,petugas']);
  // }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $products = Product::all();
    Log::info('User mengakses indeks produk', ['user' => Auth::user()->id]);
    return view('products.index', compact('products'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('products.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    try {
      Log::warning('User mencoba menambahkan data produk', ['user' => Auth::user()->id, 'data' => $request]);
      $request->validate([
        'code' => 'required',
        'product_name' => 'required',
        'quantity' => 'required',
        'price' => 'required'
      ]);
      $array = $request->only([
        'code', 'product_name', 'quantity', 'price'
      ]);
      $products = Product::create($array);
      Log::info('Berhasil menambah product baru', ['user' => Auth::user()->id, 'product' => $products->id]);
      return redirect()->route('products.index')->with('success_message', 'Berhasil menambah Produk baru');
    } catch (\Exception $e) {
      Log::error('Format yang anda masukkan salah !', ['user' => Auth::user()->id, 'data' => $request]);
      return redirect()->route('products.create')->with('error_message', 'Format yang anda masukkan salah');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function show(Product $product)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $products = Product::findOrFail($id);
    return view('products.edit', [
      'product' => $products
    ]);
  }
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $request->validate([
      'code' => 'required | min:13 | max:13',
      'product_name' => 'required',
      'quantity' => 'required',
      'price' => 'required'
    ]);
    $product = product::find($id);
    $product->code = $request->code;
    $product->product_name = $request->product_name;
    $product->quantity = $request->quantity;
    $product->price = $request->price;
    if ($product->save()) {
      Log::info('Berhasil mengubah product', ['user' => Auth::user()->id, 'product' => $product->id]);
      return redirect()->route('products.index')->with('success_message', 'Berhasil mengupdate produk ');
    }
    Log::error('Data yang diubah tidak sesuai dengan format yang ditentukan', ['user' => Auth::user()->id, 'product' => $product->id, 'data' => $request]);
    return with('error_message', 'Format Tidak sesuai');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $product = Product::find($id);
    //menambahkan code
    if ($product) {
      Log::info('User berhasil menghapus data', ['user' => Auth::user()->id, 'product' => $id]);
      $product->delete();
      return redirect()->route('products.index')
        ->with('success_message', 'Berhasil menghapus produk', ['product' => $product]);
    }
    Log::error('Data tidak tidak ditemukan user untuk dihapus', ['user' => Auth::user()->id, 'product' => $id]);
    return with('error_message', 'Format Tidak sesuai'); //404
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
}
