@extends('layouts.app')

@section('content')
    <h1>Transaksi</h1>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga Barang</th>
                <th>Jumlah Barang</th>
                <th>Total Harga Barang</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->NamaBarang }}</td>
                    <td>{{ $transaksi->HargaBarang }}</td>
                    <td>{{ $transaksi->JumlahBarang }}</td>
                    <td>{{ $transaksi->TotalHargaBarang }}</td>
                    <td>
                        <a href="{{ route('transaksi.show', $transaksi) }}" class="btn btn-primary btn-sm">Show</a>
                        <a href="{{ route('transaksi.edit', $transaksi) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('transaksi.destroy', $transaksi) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Tambah Transaksi</h2>

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
    <form method="POST" action="{{ route('transaksi.store') }}">
    @csrf

    <h2>Pembayaran</h2>

    <div class="form-group">
        <label for="total_harga">Total Harga</label>
        <input type="number" name="total_harga" id="total_harga" class="form-control mb-2" readonly value="{{ $transaksi->TotalHargaBarang }}">
    </div>

    <div class="form-group">
        <label for="pembayaran">Pembayaran</label>
        <input type="number" name="pembayaran" id="pembayaran" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="kembalian">Kembalian</label>
        <input type="number" name="kembalian" id="kembalian" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Bayar</button>
</form>
  
@endsection
