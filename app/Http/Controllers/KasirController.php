<?php

namespace App\Http\Controllers;

use App\Models\history;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{
 
    public function dashboard(){
        $date = Carbon::now()->toDateString();
        $result = history::check();

        $img = $result['status'];
        $persen = $result['persentase'];

        return view('cashier-page.dashboard',[
            'histories'=>history::select('tipe','keterangan','updated_at')->whereDate('created_at',$date)->get(),
            'img'=>$img,
            'persen'=>$persen
        ]);

    }

    public function products(){
        return view('cashier-page.product');
    }

    public function transaction(){

        $harga = 0;
        $untung = 0;
        $result = history::check();

        $img = $result['status'];
        $persen = $result['persentase'];

        $data = history::select('harga','untung','nama','created_at')->where('tipe','STORE')->get();
        foreach($data as $d){
            $harga += $d->harga;
            $untung += $d->untung;
        }

        return view('cashier-page.transaction',[
            'data'=>$data,
            'harga'=>$harga,
            'untung'=>$untung,
            'img'=>$img,
            'persen'=>$persen
        ]);
    }

    public function cashier()
    {
        return view('cashier-page.cashier');
    }
}
