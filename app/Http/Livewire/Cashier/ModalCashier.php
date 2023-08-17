<?php

namespace App\Http\Livewire\Cashier;

use App\Models\history;
use App\Models\product;
use Carbon\Carbon;
use Livewire\Component;

class ModalCashier extends Component
{
    public $products = [];  
    public $nomorTransaksi; 
    public function render()
    {
        $datePart = Carbon::now()->format('md');
        $randomPart = mt_rand(10000000, 99999999);

        $this->nomorTransaksi =  "{$datePart}-{$randomPart}";

        return view('livewire.cashier.modal-cashier');
    }

    protected $listeners = [
        'setValue',
        'resetValue',
        'storeInput'
    ];

    public function setValue($data)
    {
        $this->products = $data;
    }

    public function resetValue()
    {
        $this->products = [];
    }
    public function storeInput() 
    {
        $namaProduk = [];
        $harga = 0;
        $untung = 0 ;

        foreach($this->products as $product){
            $wrap = product::where('nama', $product['nama'])->first();
            $wrap->qty = $wrap->qty - $product['qty'];
            $wrap->save();
            $namaProduk[] = $wrap['nama'] . '(x' . $product['qty'] . ')';
            $harga += $wrap['hargaPenjualan'];
            $untung += $wrap['untung'];
        }
    
        $nama = implode(', ', $namaProduk);

        $data = [
            'nomorTransaksi'=>$this->nomorTransaksi,
            'nama'=>$nama,
            'harga'=>$harga,
            'untung'=>$untung
        ];

        history::store($data);

        return redirect('/kasir');
    }
}
