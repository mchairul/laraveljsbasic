<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pesanan;
use App\Models\DetailPesanan;


class Dom extends Controller
{
    //
    public function index()
    {
        return view('dom');
    }

    public function postdata(Request $request)
    {
        //dd($request);
        $nama = $request->nama;
        $pesanan = new Pesanan();
        
        $pesanan->nama = $nama;
        $pesanan->save();

        $idPesanan = $pesanan->id;

        $arrayPesanan = [];

        for ($i = 0; $i < count($request->menu); $i++) {
            $arrayPesanan[] = [
                "id_pesanan" => $idPesanan,
                "tgl_pesan" => date('Y-m-d H:i:s'),
                "menu" => $request->menu[$i],
                "harga" => $request->harga[$i],
            ];
        }
        DetailPesanan::insert($arrayPesanan);
        return redirect('dom');
    }

    public function struk()
    {
        return view('struk');
    }
}
