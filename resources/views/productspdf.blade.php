<!DOCTYPE html>
<html lang="en">
<head>
  <title>Download Report Barang</title>
  <style>
    table.center {
      border: 1px solid black;
      }
  </style>
</head>
<body>
    <h2>{{ $title }}</h2>
    <p>Tanggal : {{ $date }}</p>
    <table class="table table-horver table-bordered table-stripped" rules="all" border="1px" style="width: 95%;">
      <thead>
        <tr>
          <th>No.</th>
          <th>Kode</th>
          <th>Nama</th>
          <th>Jumlah</th>
          <th>Harga</th>
        </tr>
      </thead>
      <tbody>
      @foreach($product as $key => $barangs)
        <tr>
          <th scope="row">{{$key+1}}</th>
          <td>{{$barangs->code}}</td>
          <td>{{$barangs->product_name}}</td>
          <td>{{$barangs->quantity}}</td>
          <td>{{$barangs->price}}</td>
        </tr>
      @endforeach
      </tbody>
      </table>
</body>
</html>