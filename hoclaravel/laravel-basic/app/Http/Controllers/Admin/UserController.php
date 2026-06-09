<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {
    
    }
    public function index() {
        $data =  $this->userService->getUsers();
        return response()->json([
            "success" => true,
            "data" => $data,
            "message" => "Get users success"
        ]);
    }
}
