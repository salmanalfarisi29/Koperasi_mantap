
@extends('layouts.app')

@section('content')
    <h1>Detail Transaksi</h1>

    <table class="table table-bordered table-striped">
        <tr>
            <th>Nama Barang</th>
            <td>{{ $transaksi->NamaBarang }}</td>
        </tr>
        <tr>
            <th>Harga Barang</th>
            <td>{{ $transaksi->HargaBarang }}</td>
        </tr>
        <tr>
            <th>Jumlah Barang</th>
            <td>{{ $transaksi->JumlahBarang }}</td>
        </tr>
        <tr>
            <th>Total Harga Barang</th>
            <td>{{ $transaksi->TotalHargaBarang }}</td>
        </tr>
    </table>

    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
@endsection