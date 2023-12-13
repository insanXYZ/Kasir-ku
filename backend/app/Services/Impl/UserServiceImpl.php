<?php

namespace App\Services\Impl;

use App\Models\User;
use Illuminate\Support\Str;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class UserServiceImpl implements UserService {
  public $user ;
  public function __construct(User $user){
    $this->user = $user;
  }
  public function register($data)
  {
    $user = $this->user::create([
      "name" => $data["name"],
      "password" => Hash::make($data["password"])
    ]);

    return response()->json([
      "user"=> $user
    ]);
  }
  
  public function login($data)
  {
    $user = $this->user::where("name",$data["cashier_id"])->first();
    if (!$user || !Hash::check($data["password"], $user->password)) {
        return response([
          "message" => "Id kasir atau password salah"
        ], 401);
    }
    $token = $user->createToken('auth_token')->plainTextToken;
    return response()->json([
      "type" => "Bearer",
      "token" => $token
    ]);
  }
}