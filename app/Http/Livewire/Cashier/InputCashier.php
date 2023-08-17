<?php

namespace App\Http\Livewire\Cashier;

use App\Models\product;
use Livewire\Component;

class InputCashier extends Component
{
    public $barqode;
    public function render()
    {
        return view('livewire.cashier.input-cashier');
    }

    public function input()
    {
        $this->emit('setTable',$this->barqode);
        $this->resetInput();
    }
    public function resetInput()
    {
        $this->barqode='';
    }
}
