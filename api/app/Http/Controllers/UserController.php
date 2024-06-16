<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController
{
    private $service;

    function __construct(UserService $service)
    {
        $this->service = $service;
    }

    protected function getService(): UserService
    {
        return $this->service;
    }

    function index(Request $request)
    {
        return  $this->getService()->index($request);
    }

    function store(StoreUpdateUserFormRequest $request)
    {
        return $this->getService()->store($request);
    }

    function update(StoreUpdateUserFormRequest $request, int $id)
    {
        return  $this->getService()->update($request, $id);
    }

    function show($id)
    {
        return $this->getService()->show($id);
    }

    function destroy($id)
    {
        return $this->getService()->destroy($id);
    }

    function alterarSenhaUsuario(Request $request)
    {
        return  $this->getService()->alterarSenhaUsuario($request);
    }

    function resetSenha(Request $request)
    {
        return  $this->getService()->resetSenha($request);
    }
}
