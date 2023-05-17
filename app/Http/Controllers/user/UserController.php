<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\item\Tiket;
use App\Models\item\TiketSold;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() :View
    {
        $tiket = DB::table('data_tiket')
            ->select(DB::raw('type, price, count(id) as jml_tiket'))
            ->groupBy(DB::raw('1,2'))
            ->get();
        return view('user.index', [
            'tiket' => $tiket
        ]);
    }

    public function storeTiket(Request $request)
    {
        $tiketAvailable = DB::table('data_tiket')
            ->where('type', $request->tipe)
            ->take($request->jml_tiket)->get();

        foreach($tiketAvailable as $tiket) {
            $tiketSold = new TiketSold;
            $tiketSold->name = $request->nama;
            $tiketSold->email = $request->email;
            $tiketSold->tiket_number = $tiket->tiket_number;
            $tiketSold->type = $tiket->type;
            $tiketSold->price = $tiket->price;
            $tiketSold->is_checkin = 0;
            $tiketSold->save();

            Tiket::find($tiket->id)->delete();
        }

        return back()->with([
            'success' => 'Berhasil di checkout!'
        ]);
    }
}
