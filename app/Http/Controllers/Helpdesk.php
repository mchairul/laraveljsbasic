<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tickets;

class Helpdesk extends Controller
{
    public function index()
    {
        return view('helpdesk');
    }

    public function addticket(Request $request)
    {
        $user = $request->user;
        $description = $request->description;
        $att = $request->att;

        $tickets = new Tickets();

        $tickets->tanggal = date('Y-m-d H:i:s');
        $tickets->user = $user;
        $tickets->description = $description;
        $tickets->attachment = $att;
        $tickets->save();

        
    }
}
