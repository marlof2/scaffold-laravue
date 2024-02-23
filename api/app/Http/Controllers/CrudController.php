<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class CrudController extends Controller
{
    private $service;

    protected function __construct(object $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): Response
    {
        {
            if($request->input()) {
                if($request->input('per_page')) {
                    return response($this->service->paginate($request->input('per_page')), 200);
                }
                return response($this->service->applyFilter($request->input(), 200));
            } else {
                return response($this->service->getAll(), 200);
            }
        }
    }

    public function store(Request $request): JsonResponse
    {
        $this->service->store($request->all());
        return response()->json(['message' =>'Registro inserido com sucesso.'], 201);
    }

    public function show(int $id): Response
    {
        $response = $this->service->findById($id);
        return response($response,200);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $this->service->update($request->all(), $id);
        return response()->json(['message' =>'Registro atualizado com sucesso.'], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->destroy($id);
        return response()->json(['message' =>'Registro deletado com sucesso.'], 200);
    }
}
