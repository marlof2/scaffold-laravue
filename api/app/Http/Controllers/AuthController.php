<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $userService;

    function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginFormRequest $request)
    {
       return  $this->userService->login($request);

        // return  response(['token' => $response], 200);
    }

    public function me(Request $request)
    {
        $response = $this->userService->me($request);
        return response($response, 200);
    }

    public function logout(Request $request)
    {
        $response = $this->userService->logout($request);
        return response(['message' => 'Deslogado com sucesso.'], 200);
    }
}
