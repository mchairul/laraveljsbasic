<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Sales;

class Report extends Controller
{
    //
    public function index(Request $request)
    {
        //dd($request->tgl);
        $tgl = $request->tgl;
        if ($tgl === "" OR is_null($tgl)) {
            $dataSales = Sales::all();
        } else {
            $dataSales = Sales::where( DB::raw('date(tgl_penjualan)'), $tgl)
            ->get();
        }
        //dd($dataSales);
        return view('report',[
            'tgl' => $tgl,
            "dataSales" => $dataSales
        ]);
    }
}
