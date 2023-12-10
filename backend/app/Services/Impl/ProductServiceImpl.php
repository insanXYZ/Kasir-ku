<?php

namespace App\Services\Impl;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;

class ProductServiceImpl implements ProductService 
{
  public $product;
  public function __construct(Product $product) {
    $this->product = $product;
  }
  public function create($data){
    $product = $this->product->create($data);

    return response()->json([
      "product" => $product
    ]);
  }
  public function get(){
    return response()->json([
      "data" => $this->product::latest()->get()
    ]);
  }
  public function delete($id){
    $Product = Product::find($id);
    $Product->delete();
    return $Product;
  }
  public function update($id,$data){
    $product = Product::find($id)->update($data);

    return response()->json([
      "product" => $product
    ]);
  }
}