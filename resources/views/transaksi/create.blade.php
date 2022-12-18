@extends('layouts.app')

@section('content')
    <h1>Tambah Transaksi</h1>

    <form method="POST" action="{{ route('transaksi.store') }}">
        @csrf

        <div class="form-group">
            <label for="code">Kode Barang</label>
            <input type="text" name="code" id="code" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="jumlah_barang">Jumlah Barang</label>
            <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
@endsection
