<?php

namespace App\Services;

interface UserService {
  public function register($data);
  public function login($data);
}