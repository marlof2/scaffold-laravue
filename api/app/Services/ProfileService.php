<?php

namespace App\Services;

use App\Http\Resources\ProfileResources;
use App\Models\Profile;
use App\Models\ProfileAbility;
use Illuminate\Http\Response;

class ProfileService
{

    private $profile;

    function __construct(Profile $profileModel)
    {
        $this->profile = $profileModel;
    }


    public function index($request)
    {
        if ($request->filled('name')) {
            return response()->json($this->profile->where('name', 'LIKE', '%' . $request->name . '%')->paginate(10));
        }

        if ($request->filled('limit')) {
            return  $this->profile->orderBy('name', 'asc')->get();
        }

        $profile = $this->profile->with('abilities')->paginate(10);

        return response()->json($profile, Response::HTTP_OK);
    }


    public function store($request)
    {
        $dataFrom = $request->all();
        try {
            $data = $this->profile->create($dataFrom);
            return response()->json($data, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Não foi possível cadastrar', "error" => $e->getMessage()], Response::HTTP_NOT_ACCEPTABLE);
        }
    }


    public function update($request, $id)
    {
        $dataFrom = $request->all();
        try {
            $data = $this->profile->whereId($id)->update($dataFrom);
            return response()->json(['message' => 'Atualizado com sucesso.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Não foi possível alterar', "error" => $e->getMessage()], Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    public function destroy($id)
    {
        $data = $this->profile->find($id);
        if (!$data) {
            return response()->json(['message' => 'Não foi possível executar a ação', 'error' => ['Dados não encontrados']], Response::HTTP_NOT_FOUND);
        }
        try {
            $data->delete();
            return response()->json(['success' => 'Deletado com sucesso.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Não foi possível excluir', "error" => $e->getMessage()], Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    public function getAbilities(int $id): Profile
    {
        return $this->profile->with('abilities')->findOrFail($id);
    }

    public function addPermissions($id, $request)
    {

        try {

            $profileAbility = new ProfileAbility();
            $dataFrom = $request->all();

            $count =  $profileAbility::where('profile_id', $id)->count();

            if ($count > 0) {
                $profileAbility::where('profile_id', $id)->delete();
            }

            foreach ($dataFrom['abilities'] as $value) {
                $result = $profileAbility::create([
                    'ability_id' => $value,
                    'profile_id' => $id,
                ]);
            }

            return response()->json(['message' =>'Cadastrado com sucesso'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Não foi possível cadastrar', "error" => $e->getMessage()], Response::HTTP_NOT_ACCEPTABLE);
        }
    }
}
