<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;

class SearchProduct extends Component
{
    public $data;
    public function render()
    {
        return view('livewire.product.search-product');
    }
    public function search()
    {
        $this->emit('search', $this->data);
    }
}
