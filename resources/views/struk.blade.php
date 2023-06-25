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
    <tr>
        <td>Ayam</td>
        <td>Rp</td>
        <td>15000</td>
    </tr>
    <tr>
        <td>Ayam</td>
        <td>Rp</td>
        <td>15000</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td><b>Total</b></td>
        <td><b>Rp</b></td>
        <td><b>15000</b></td>
    </tr>
</table>
</div>
<button onclick="window.print()">cetak</button>
@endsection

@section('js')
<script>
    
</script>
@endsection