<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download Laporan Stok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
                table.center {
                border: 1px solid black;
                margin-left: auto;
                margin-right: auto;
                }
                table.center th{
                border: 1px solid black;
                }
                table.center td{
                border: 1px solid black;
                }
     </style>
</head>
<body>
    <h2>{{ $title }}</h2>
    <p>Tanggal : {{ $date }}</p>
    <table class="table table-5m" >

        <table class="table table-striped table-bordered " style="border:1;">
        <table width="300px">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga</th>
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