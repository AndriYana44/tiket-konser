<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\item\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function index()
    {
        $data = Tiket::all();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $time = date('H:i:s');

        return view('tiket.index', [
            'date'=>$date,
            'time'=>$time,
            'data' => $data
        ]);
    }
    public function store(Request $request)
    {   
        $tiket = new Tiket();
        $tiket->tiket_number = $request->tiket_num;
        $tiket->type = $request->jenis;
        $tiket->price = $request->harga;
        $tiket->created_at = $request->date;
        $tiket->save();

        return back()->with([
            'success' => 'Tiket created!',
        ]);
    }

    public function destroy($id)
    {
        Tiket::find($id)->delete();
        return back()->with([
            'success' => 'Tiket berhasil dihapus!'
        ]);
    }
}
