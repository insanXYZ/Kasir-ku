<?php

namespace App\Services;

interface ProductService{
  public function create($data);
  public function get();
  public function delete($id);
  public function update($id,$data);
}