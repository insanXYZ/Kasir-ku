<?php

namespace App\Http\Livewire\Product;

use App\Models\history;
use App\Models\product;
use Livewire\Component;

class UpdateProduct extends Component
{
    public $nama;
    public $hargaPerolehan;
    public $hargaPenjualan;
    public $barqode;
    public $qty;
    public $setBarqode;
    public function render()
    {
        return view('livewire.product.update-product');
    }
    protected $listeners= [
        'setInput'
    ];

    public function store(){
        $this->validate([
            'nama'=>'required',
            'hargaPerolehan'=>'required|integer',
            'hargaPenjualan'=>'required|integer',
            'barqode'=>'required',
            'qty'=>'required'
        ]);

        $wrap = product::where('barqode',$this->setBarqode)->first();

        $wrap->nama = $this->nama;
        $wrap->hargaPenjualan = $this->hargaPenjualan;
        $wrap->hargaPerolehan = $this->hargaPerolehan;
        $wrap->barqode = $this->barqode;
        $wrap->qty = $this->qty;
        $wrap->untung = $this->hargaPenjualan - $this->hargaPerolehan;
        $wrap->save();

        history::updateProduk($this->setBarqode);

        $this->emit('refreshTable');
    }

    public function resetInput()
    {
        $this->nama ='';
        $this->hargaPenjualan = '';
        $this->hargaPerolehan = '';
        $this->barqode = '' ;
        $this->qty = '' ;
        $this->setBarqode ='';
    }
    public function setInput($produk)
    {
        $data =json_decode($produk);
        $this->nama =$data->nama;
        $this->hargaPenjualan = $data->hargaPenjualan;
        $this->hargaPerolehan = $data->hargaPerolehan;
        $this->barqode = $data->barqode;
        $this->qty = $data->qty;
        $this->setBarqode = $data->barqode;
    }
}
