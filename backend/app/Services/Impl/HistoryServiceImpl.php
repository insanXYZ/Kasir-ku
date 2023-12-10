<?php

namespace App\Services\Impl;
use App\Models\History;
use App\Services\HistoryService;

class HistoryServiceImpl implements HistoryService{
  public $history;
  public function __construct(History $history){
    $this->history = $history;
  }
  public function create($type = 'Tambah | Hapus | Perbarui | Beli' ,$barqode, $data = null){
    if ($type == "Tambah"){
      $this->history->create([
        "type" => $type,
        "numberTransaction"=> null,
        "products"=>null,
        "price"=> null,
        "profit" => null,
        "money" => null,
        "description" => "Tambah barang dengan kode barqode ". $barqode
      ]);
    }
    if ($type == "Hapus"){
      $this->history->create([
        "type" => $type,
        "numberTransaction"=> null,
        "products"=>null,
        "price"=> null,
        "money" => null,
        "profit" => null,
        "description" => "Hapus barang dengan kode barqode ". $barqode
      ]);
    }
    if ($type == "Perbarui"){
      $this->history->create([
        "type" => $type,
        "numberTransaction"=> null,
        "products"=>null,
        "price"=> null,
        "money" => null,
        "profit" => null,
        "description" => "Perbarui barang dengan kode barqode ". $barqode
      ]);
    }
    if ($type == "Beli"){
      $this->history->create([
        "type" => $type,
        "numberTransaction"=> $data["numberTransaction"],
        "products"=>$data["product"],
        "price"=> $data["price"],
        "money" => $data["money"],
        "profit" => $data["profit"],
        "description" => "Barang dibeli ". $data["product"]
      ]);
    }
  }
  public function responseTransaction(\Illuminate\Http\Request $request){
    // if($request)
  }
}