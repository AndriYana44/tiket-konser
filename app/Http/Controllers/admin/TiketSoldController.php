<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\item\TiketSold;
use Illuminate\Http\Request;

class TiketSoldController extends Controller
{
    public function index()
    {
        $tiket = TiketSold::all();
        return view('tiket.tiket_sold', [
            'tiket_sold' => $tiket
        ]);
    }
}
