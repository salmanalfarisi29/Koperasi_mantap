<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\Transaction_detail;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class Transaction_detailController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('product_name')->get();

        // Cek apakah ada transaksi yang sedang berjalan
        if ($id_transaksi = session('id_transaksi')) {
            $Transactions = Transactions::find($id_transaksi);

            return view('Transactions_detail.index', compact('Product', 'id_transaksi', 'Transactions'));
        } else {
            if (auth()->user()->level == 1) {
                return redirect()->route('transaction.baru');
            } else {
                return redirect()->route('home');
            }
        }
    }

    public function data($id)
    {
        $detail = Transaction_detail::with('Product')
            ->where('id_transaksi', $id)
            ->get();

        $data = array();
        $total = 0;
        $jumlah_beli = 0;

        foreach ($detail as $item) {
            $row = array();
            $row['code'] = '<span class="label label-success">'. $item->Product['code'] .'</span';
            $row['product_name'] = $item->Product['product_name'];
            $row['harga_jual']  = 'Rp. '. format_uang($item->harga_jual);
            $row['jumlah']      = '<input type="number" class="form-control input-sm quantity" data-id="'. $item->id_transaksi_detail .'" value="'. $item->jumlah .'">';
            $row['subtotal']    = 'Rp. '. format_uang($item->subtotal);
            $row['aksi']        = '<div class="btn-group">
                                    <button onclick="deleteData(`'. route('transaksi.destroy', $item->id_transaksi_detail) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                </div>';
            $data[] = $row;

            $total += $item->harga_jual * $item->jumlah - ($item->jumlah / 100 * $item->harga_jual);;
            $jumlah_beli += $item->jumlah;
        }
        $data[] = [
            'code' => '
                <div class="total hide">'. $total .'</div>
                <div class="jumlah_beli hide">'. $jumlah_beli .'</div>',
            'product_name' => '',
            'harga_jual'  => '',
            'jumlah'      => '',
            'subtotal'    => '',
            'aksi'        => '',
        ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['aksi', 'code', 'jumlah'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $products = Product::where('code', $request->code)->first();
        if (! $products) {
            return response()->json('Data gagal disimpan', 400);
        }

        $detail = new Transaction_detail();
        $detail->id_transaksi = $request->id_transaksi;
        $detail->code = $products->code;
        $detail->harga_jual = $products->harga_jual;
        $detail->jumlah = 1;
        $detail->subtotal = $products->harga_jual;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function update(Request $request, $id)
    {
        $detail = Transaction_detail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->harga_jual * $request->jumlah - (($detail->diskon * $request->jumlah) / 100 * $detail->harga_jual);;
        $detail->update();
    }

    public function destroy($id)
    {
        $detail = Transaction_detail::find($id);
        $detail->delete();

        return response(null, 204);
    }

    public function loadForm($diskon = 0, $total = 0, $diterima = 0)
    {
        $bayar   = $total;
        $kembali = ($diterima != 0) ? $diterima - $bayar : 0;
        $data    = [
            'totalrp' => format_uang($total),
            'bayar' => $bayar,
            'bayarrp' => format_uang($bayar),
            'terbilang' => ucwords(terbilang($bayar). ' Rupiah'),
            'kembalirp' => format_uang($kembali),
            'kembali_terbilang' => ucwords(terbilang($kembali). ' Rupiah'),
        ];

        return response()->json($data);
    }
}
