<?php

namespace App\Services;

use Illuminate\Http\Request;

interface HistoryService{
  public function create($type , $barqode , $data);
  public function responseTransaction(Request $request);
}