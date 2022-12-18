@extends('layouts.app')

@section('content')
    <h1>Edit Transaksi</h1>

    <form method="POST" action="{{ route('transaksi.update', $transaksi) }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="code">Kode Barang</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ $transaksi->NamaBarang }}" required>
        </div>

        <div class="form-group">
            <label for="jumlah_barang">Jumlah Barang</label>
            <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" value="{{ $transaksi->JumlahBarang }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
