<?php

namespace App\Http\Livewire\Cashier;

use App\Models\product;
use Livewire\Component;

class TableCashier extends Component
{
    public $products = [];
    public function render()
    {
        return view('livewire.cashier.table-cashier');
    }
    protected $listeners= [
        'setTable',
        'deleteInput'
    ];
    public function setTable($barqode)
    {
    $product = product::where('barqode', $barqode)->first();

    if ($product) {
        $productArray = [
            "id" => $product->id,
            "nama" => $product->nama,
            "qty" => $product->qty,
            "hargaPerolehan" => $product->hargaPerolehan,
            "hargaPenjualan" => $product->hargaPenjualan,
            "untung" => $product->untung,
            "barqode" => $product->barqode,
        ];
        array_push($this->products, $productArray);
        }
    }

    public function deleteInput($barqode)
    {
        foreach ($this->products as $index => $item) {
            if ($item['barqode'] === $barqode) {
                unset($this->products[$index]);
                break;
            }
          }
    }
}