@extends('layouts.main')

@section('css')

@endsection

@section('main-content')
<input id="tgl" type="text" value="" placeholder="tanggal"> <button onclick="searchByDate()">Cari</button>
<br>
<br>
<table border="1" id="data-table">
    <tr>
        <th>Tanggal</th>
        <th>Nama Produk</th>
        <th>Qty</th>
        <th>Harga</th>
        <th>Total</th>
    </tr>
    @forelse ($dataSales as $sales)
    <tr>
        <td>{{ $sales->tgl_penjualan}}</td>
        <td>{{ $sales->nama_produk}}</td>
        <td>{{ $sales->quantity}}</td>
        <td>{{ $sales->harga}}</td>
        <td>{{ $sales->total}}</td>
    </tr>
    @empty
    <p>no data</p>
    @endforelse
</table>
<br>
<button onclick="doit('xlsx');">
    export to xls
</button>
@endsection

@section('js')
<!-- use version 0.19.3 -->
<script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.19.3/package/dist/xlsx.full.min.js"></script>
<script>
    var queryString = window.location.search;
    console.log(queryString);

    var urlSearchParam = new URLSearchParams(queryString);
    console.log(urlSearchParam.get('tgl'));
    var getTgl = urlSearchParam.get('tgl');

    if(getTgl !== null)
        var tglForNameFile = getTgl;
    else
        var tglForNameFile = '';

    function doit(type, fn) {
        var elt = document.getElementById('data-table');
        var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
        XLSX.writeFile(wb, fn || ('Data Penjualan.' + tglForNameFile + (type || 'xlsx')));
    }

    function searchByDate()
    {
        var tgl = document.getElementById('tgl').value;
        console.log(tgl);
        window.location.href = 'report?tgl=' + tgl
    }
</script>
@endsection
