<?php

namespace App\Http\Livewire\Product;

use App\Models\history;
use App\Models\product;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class TableProduct extends Component
{
    use WithPagination;
    public $search;
    public $paginate = 15;
    public $downloadWrapper;

    protected $getProduct;
    public function render()
    {
        $this->resetProduct();
        return view('livewire.product.table-product',[
            'products' =>$this->getProduct
        ]);
    }
    public function resetProduct()
    {
        return $this->getProduct = $this->search == '' ?
                            product::latest()->paginate($this->paginate) :
                            product::where('barqode' , 'like','%'.$this->search.'%')
                            ->orWhere('nama','like','%'.$this->search.'%')->paginate($this->paginate);
    }
    protected $listeners = [
        'refreshTable',
        'search',
        'destroy',
        'generateJson'
    ];

    public function refreshTable(){

    }

    public function generateJson()
    {
        $this->downloadWrapper = product::select('nama','qty','hargaPerolehan','hargaPenjualan','untung','barqode')->get();

        $nowDate = Carbon::now();
        $nowDate = $nowDate->isoFormat('DD-MMMM-YYYY');

        $filename = 'produk'.$nowDate.'.json';

        return response()->streamDownload(function () {
            echo json_encode($this->downloadWrapper,JSON_PRETTY_PRINT);
        }, $filename, ['Content-Type' => 'application/json']);
    }

    public function downloadJson($data)
    {
        $this->downloadWrapper = product::where('barqode', $data)->select('nama','qty','hargaPerolehan','hargaPenjualan','untung','barqode')->get();

        $filename = $data.'.json';

        return response()->streamDownload(function () {
            echo json_encode($this->downloadWrapper,JSON_PRETTY_PRINT);
        }, $filename, ['Content-Type' => 'application/json']);
    }

    public function destroy($data)
    {
        product::where('barqode',$data)->delete();
        history::deleteProduk($data);
    }

    public function search($data)
    {
        $this->search = $data;
    }
}
