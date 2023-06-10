<?php

namespace App\Http\Controllers;

use App\Models\Sales;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Grafik extends Controller
{
    //
    public function index()
    {
        $dataSales = DB::table('sales')
        ->select(DB::raw('date(tgl_penjualan) as tgl'), DB::raw('sum(quantity) as qty'), DB::raw('sum(harga) as harga'), DB::raw('sum(total) as total'))
        ->groupBy(DB::raw('date(tgl_penjualan)'))->get();
        //dd($dataSales);
        return view('grafik',[
            "dataSales" => $dataSales
        ]);
    }
}
