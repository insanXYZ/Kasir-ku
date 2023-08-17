<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class history extends Model
{
    use HasFactory;

    protected $guarded =[
        'id'
    ];


    public static function updateProduk($barqode)
    {
        history::create([
            'tipe'=>'UPDATE',
            'keterangan'=>'Memperbarui produk yang mempunyai kode barqode '. $barqode
        ]);
    }

    public static function plusProduk($barqode)
    {
        history::create([
            'tipe'=>'CREATE',
            'keterangan'=>'Membuat produk dengan kode barqode '. $barqode
        ]);
    }

    public static function deleteProduk($barqode)
    {
        history::create([
            'tipe'=>'DELETE',   
            'keterangan'=>'Menghapus produk yang mempunyai kode barqode '.$barqode
        ]);
    }

    public static function store($data)
    {
        history::create([
            'tipe'=>'STORE',
            'nomorTransaksi'=>$data['nomorTransaksi'],
            'nama'=>$data['nama'],
            'harga'=>$data['harga'],
            'untung'=>$data['untung'],
            'keterangan'=>$data['nama']
        ]);
    }

    public static function check()
    {
        $now = 0;
        $tomorrow = 0;

        $nowData = history::select('harga')->whereDate('created_at',Carbon::now()->toDateString())->get();

        if(count($nowData)> 0){
            foreach($nowData as $price){
                $now += $price->harga;
            }
        }

        $tomorrowData = history::select('harga')->whereDate('created_at',Carbon::yesterday()->toDateString())->get();

        if(count($tomorrowData)> 0){
            foreach($nowData as $price){
                $now += $price->harga;
            }
        }
        if ($tomorrow != 0) {
            if ($now > $tomorrow) {
                $result = ['status' => 'up', 'persentase' => ($now / $tomorrow) * 100];
            } else {
                $result = ['status' => 'down', 'persentase' => ($now / $tomorrow) * 100];
            }
        } else {
            $result = ['status' => 'up', 'persentase' => 0];
        }
    
        return $result;
    }
}
