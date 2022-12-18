<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Product;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function __construct() {
		$this->middleware('role:pembeli'); // untuk membatasi yang hanya user mempunyai role admin, petugas, dan pembeli yang boleh mengakses HomeController
	}
    public function index()
    {
        // Retrieve all Transaksi records
        $transaksis = Transaksi::all();

        // Render the index view, passing in the Transaksi records as data
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        // Render the create view
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'code' => 'required|exists:products,code',
            'jumlah_barang' => 'required|integer|min:1',
        ]);

        // Look up the product using the provided code
        $product = Product::where('code', $request->input('code'))->first();

        // Calculate the total price for the transaction
        $total_price = $product->price * $request->input('jumlah_barang');

        // Create a new Transaksi record
        Transaksi::create([
            'NamaBarang' => $product->product_name,
            'HargaBarang' => $product->price,
            'JumlahBarang' => $request->input('jumlah_barang'),
            'TotalHargaBarang' => $total_price,
        ]);

        // Redirect to the index view
        return redirect()->route('transaksi.index');
    }

    public function show(Transaksi $transaksi)
    {
        // Render the show view, passing in the Transaksi record as data
        return view('transaksi.show', compact('transaksi'));
    }

    public function edit(Transaksi $transaksi)
    {
        // Render the edit view, passing in the Transaksi record as data
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        // Validate the request data
        $request->validate([
            'code' => 'required|exists:products,code',
            'jumlah_barang' => 'required|integer|min:1',
        ]);

        // Look up the product using the provided code
        $product = Product::where('code', $request->input('code'))->first();

        // Calculate the total price for the transaction
        $total_price = $product->price * $request->input('jumlah_barang');

        // Update the Transaksi record
        $transaksi->update([
            'NamaBarang' => $product->product_name,
            'HargaBarang' => $product->price,
            'JumlahBarang' => $request->input('jumlah_barang'),
            'TotalHargaBarang' => $total_price,
        ]);
    
        // Redirect to the index view
        return redirect()->route('transaksi.index');
    }
    public function destroy(Transaksi $transaksi)
    {
        // Delete the Transaksi record
        $transaksi->delete();

        // Redirect to the index view
        return redirect()->route('transaksi.index');
    }
}