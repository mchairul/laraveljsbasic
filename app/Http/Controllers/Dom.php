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
        return response()->json([
            'id' => $idPesanan
        ]);
    }

    public function struk(Request $request)
    {
        $idPesanan = $request->id;

        $pesanan = Pesanan::where('id', $idPesanan)->first();
        //dd($pesanan['id']);

        $detailPesanan = DetailPesanan::where('id_pesanan', $idPesanan)->get();

        return view('struk',[
            "detailPesanan" => $detailPesanan
        ]);
    }
}
