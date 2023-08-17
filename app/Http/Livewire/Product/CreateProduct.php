<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\history;
use App\Models\product;
use Illuminate\Http\Request;
class CreateProduct extends Component
{
    public $nama;
    public $hargaPerolehan;
    public $hargaPenjualan;
    public $barqode;
    public $qty;

    public function render()
    {
        return view('livewire.product.create-product');
    }
    public function store(Request $request)
    {
        $this->validate([
           'nama'=>'required',
           'hargaPerolehan'=>'required|numeric',
           'barqode'=>'required',
           'qty'=>'required' 
        ]);

        $hargaPenjualan =  $this->hargaPenjualan === null ? $this->hargaPerolehan * 1.1 : $this->hargaPenjualan;

        product::create([
            'nama'=>$this->nama,
            'hargaPerolehan'=>$this->hargaPerolehan,
            'hargaPenjualan' => $hargaPenjualan,
            'barqode'=>$this->barqode,
            'qty'=>$this->qty,
            'untung'=>$hargaPenjualan - $this->hargaPerolehan
        ]);

        history::plusProduk($this->barqode);

        $this->resetInput();
        $this->emit('refreshTable');
    }

    protected function resetInput()
    {
        $this->nama = null ;
        $this->hargaPerolehan = null ;
        $this->hargaPenjualan = null ;
        $this->barqode = null ;
        $this->qty = null ;
    }
}
