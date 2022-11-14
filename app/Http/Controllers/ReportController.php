<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{

    public function downloadPDF(){
        $product = Product::all();
        $data = [
            'title' => 'Laporan Stok Terkini',
            'date' => date('d/m/Y'),
            'product' => $product
        ];
        $pdf = PDF::loadView('productspdf', $data);
        return $pdf->download('Laporan stock.pdf');
    }


}
