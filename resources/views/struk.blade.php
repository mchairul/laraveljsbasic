@extends('layouts.main')

@section('css')
<style>
    @media print {
    button {
        visibility: hidden;
    }
    /*#table {
        visibility: visible;
        position: absolute;
        left: 0;
        top: 0;
    }*/
    }
</style>
@endsection

@section('main-content')
<div id="table">
<table width="100%" style="text-align:left;">
    <tr>
        <th>Menu</th>
        <th></th>
        <th>Prize</th>
    </tr>
    @php
        $total = 0;
    @endphp
    @forelse ($detailPesanan as $pesanan)
    <tr>
        <td>{{ $pesanan->menu }}</td>
        <td>Rp</td>
        <td>Rp {{ $pesanan->harga }}</td>
    </tr>

    @php
        $total += intval($pesanan->harga);
    @endphp

    @empty
    <p>no data</p>
    @endforelse
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td><b>Total</b></td>
        <td><b>Rp</b></td>
        <td><b>{{ $total }}</b></td>
    </tr>
</table>
</div>
<button onclick="window.print()">cetak</button>
<button onclick="window.location.href = '/dom'">kembali</button>
@endsection

@section('js')
<script>
    
</script>
@endsection