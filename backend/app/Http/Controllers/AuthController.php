<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Services\Impl\UserServiceImpl;

class AuthController extends Controller 
{
    public $userService;
    public function __construct(UserServiceImpl $userService){
        $this->userService = $userService;
    }
    public function register(RegisterRequest $request){
        $validated = $request->validated();
        return $this->userService->register($validated);
    }

    public function login(LoginRequest $request){
        $validated = $request->validated();
        return $this->userService->login($validated);
    }

    public function logout(){
        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json(["logout"=> true]);
    }
}
