<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Transaction_detail;
use App\Models\product;
use App\Models\Setting;
use Illuminate\Http\Request;
use PDF;

class TransactionController extends Controller
{
    public function index()
    {
        return view('Transaction.index');
    }

    public function data()
    {
        $transactions = Transaction::with('member')->orderBy('id_transaksi', 'desc')->get();

        return datatables()
            ->of($transactions)
            ->addIndexColumn()
            ->addColumn('jumlah_beli', function ($transactions) {
                return format_uang($transactions->jumlah_beli);
            })
            ->addColumn('total_harga', function ($transactions) {
                return 'Rp. '. format_uang($transactions->total_harga);
            })
            ->addColumn('uang_pembayaran', function ($transactions) {
                return 'Rp. '. format_uang($transactions->uang_pembayaran);
            })
            ->addColumn('tanggal', function ($transactions) {
                return tanggal_indonesia($transactions->created_at, false);
            })
            ->addColumn('aksi', function ($transactions) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('Transaction.show', $transactions->id_transaksi) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('Transaction.destroy', $transactions->id_transaksi) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $transactions = new Transaction();
        $transactions->email_pembeli = null;
        $transactions->jumlah_beli = 0;
        $transactions->total_harga = 0;
        $transactions->uang_pembayaran = 0;
        $transactions->id_user = auth()->id();
        $transactions->save();

        session(['id_transaksi' => $transactions->id_transaksi]);
        return redirect()->route('transaction.index');
    }

    public function store(Request $request)
    {
        $transactions = Transaction::findOrFail($request->id_transaksi);
        $transactions->email_pembeli = $request->email_pembeli;
        $transactions->jumlah_beli = $request->jumlah_beli;
        $transactions->total_harga = $request->total;
        $transactions->uang_pembayaran = $request->uang_pembayaran;
        $transactions->update();

        $detail = Transaction_detail::where('id_transaksi', $transactions->id_transaksi)->get();
        foreach ($detail as $item) {
            $item->update();

            $products = product::find($item->code);
            $products->quantity -= $item->jumlah_beli;
            $products->update();
        }

        return redirect()->route('transaksi.selesai');
    }

    public function show($id)
    {
        $detail = Transaction_detail::with('product')->where('id_transaksi', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('code', function ($detail) {
                return '<span class="label label-success">'. $detail->product->code .'</span>';
            })
            ->addColumn('product_name', function ($detail) {
                return $detail->product->product_name;
            })
            ->addColumn('price', function ($detail) {
                return 'Rp. '. format_uang($detail->price);
            })
            ->addColumn('jumlah', function ($detail) {
                return format_uang($detail->jumlah);
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Rp. '. format_uang($detail->subtotal);
            })
            ->rawColumns(['code'])
            ->make(true);
    }

    public function destroy($id)
    {
        $transactions = Transaction::find($id);
        $detail    = Transaction_detail::where('id_transaksi', $transactions->id_transaksi)->get();
        foreach ($detail as $item) {
            $products = product::find($item->code);
            if ($products) {
                $products->quantity += $item->jumlah_beli;
                $products->update();
            }

            $item->delete();
        }

        $transactions->delete();

        return response(null, 204);
    }

    public function selesai()
    {
        $setting = Setting::first();

        return view('Transaction.selesai', compact('setting'));
    }

    public function notaKecil()
    {
        $setting = Setting::first();
        $transactions = Transaction::find(session('id_transaksi'));
        if (! $transactions) {
            abort(404);
        }
        $detail = Transaction_detail::with('product')
            ->where('id_transaksi', session('id_transaksi'))
            ->get();
        
        return view('Transaction.nota_kecil', compact('setting', 'Transaction', 'detail'));
    }

    public function notaBesar()
    {
        $setting = Setting::first();
        $transactions = Transaction::find(session('id_transaksi'));
        if (! $transactions) {
            abort(404);
        }
        $detail = Transaction_detail::with('product')
            ->where('id_transaksi', session('id_transaksi'))
            ->get();

        $pdf = PDF::loadView('Transaction.nota_besar', compact('setting', 'Transaction', 'detail'));
        $pdf->setPaper(0,0,609,440, 'potrait');
        return $pdf->stream('Transaksi-'. date('Y-m-d-his') .'.pdf');
    }
}
