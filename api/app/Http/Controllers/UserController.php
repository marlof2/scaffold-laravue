<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController
{
    private $userService;

    function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    function index(Request $request)
    {
        return  $this->userService->index($request);
    }

    function store(StoreUpdateUserFormRequest $request)
    {
        $request->validated();
        return $this->userService->store($request);
    }

    function update(StoreUpdateUserFormRequest $request, int $id)
    {
        $request->validated();
        return  $this->userService->update($request, $id);
    }

    function show($id)
    {
        return $this->userService->show($id);
    }

    function destroy($id)
    {
        return $this->userService->destroy($id);
    }

    function alterarSenhaUsuario(Request $request)
    {
        return  $this->userService->alterarSenhaUsuario($request);
    }

    function resetSenha(Request $request)
    {
        return  $this->userService->resetSenha($request);
    }
}
