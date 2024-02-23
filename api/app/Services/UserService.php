<?php

namespace App\Services;

use App\Models\User;
use App\Models\ProfileAbility;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class UserService
{

    protected $user;
    protected $pageLimit;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->pageLimit = 10;
    }

    public function index($request)
    {
        if ($request->filled('search')) {
            if ($request->filled('search')) {
                return response()->json($this->user::Filtro($request->search));
            }
            // return response()->json($this->user->where('name', 'LIKE', '%' . $request->search . '%')->paginate(10));
        }

        // if ($request->filled('name')) {
        //     return response()->json($this->user->where('name', 'LIKE', '%' . $request->name . '%')->paginate(10));
        // }

        $data =  $this->user->with('profile')->paginate($this->pageLimit);

        return response()->json($data, Response::HTTP_OK);
    }

    public function store($request)
    {
        $request['password'] = Hash::make(12345);
        $dataFrom = $request->all();
        try {
            $data = $this->user->create($dataFrom);
            return response()->json($data, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Não foi possível cadastrar', "error" => $e->getMessage()], Response::HTTP_NOT_ACCEPTABLE);
        }
    }


    public function show($id)
    {

        try {
            $data = $this->user->find($id);
            return response()->json($data, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Não foi possível cadastrar', "error" => $e->getMessage()], Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    public function update($request, $id)
    {
        $dataFrom = $request->all();
        try {
            $data = $this->user->whereId($id)->update($dataFrom);
            return response()->json(['message' => 'Atualizado com sucesso.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Não foi possível alterar', "error" => $e->getMessage()], Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    public function destroy($id)
    {
        $data = $this->user->find($id);
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

    public function login($request)
    {
        $request['cpf'] = preg_replace('/[^0-9]/', '', $request->cpf);
        $user = $this->user->where('cpf', $request->cpf)->first();
        if (!$user) {
            return response()->json(['error' => 'Usuario não encontrado'], Response::HTTP_NOT_FOUND);
        };

        if (Hash::check($request->password, $user->password)) {

            $abilities = [];
            foreach ($user->profile->abilities as  $ability) {
                array_push($abilities, $ability->slug);
            }

            return $user->createToken('AccessToken', $abilities)->plainTextToken;

            // return [
            // 'token' => $user->createToken('AccessToken', $abilities)->plainTextToken,
            // 'user' => $user->with('profile')->whereId($user->id)->first()
            // ];
        }
    }

    public function me($request): array
    {
        $profile_id = $request->user()->profile()->first()->id;

        $abilities =   ProfileAbility::select('abilities.slug as abilities')
            ->join('abilities', 'abilities.id', '=', 'profile_abilities.ability_id')
            ->where('profile_abilities.profile_id', '=', $profile_id)
            ->get();


        $abilitiesAux = $abilities->pluck('abilities');

        // $abilitiesAux = base64_encode(Crypt::encryptString($abilitiesAux));

        $data['abilities'] = $abilitiesAux;
        $data['user'] = $request->user()->with('profile')->whereId($request->user()->id)->first();

        return $data;
    }

    public function logout($request)
    {
        return $request->user()->tokens()->delete();
    }



    public function alterarSenhaUsuario($request)
    {

        try {
            $user = User::whereId($request->id)->first();

            if (!$user) {
                return response([
                    'message' => 'Usuário não encontrado.'
                ], 401);
            }

            if (!Hash::check($request->senhaAntiga, $user->password)) {
                return response([
                    'message' => 'Senha antiga inválida.'
                ], 401);
            }

            if ($request->senhaNova != $request->confirmaSenhaNova) {
                return response([
                    'message' => 'A nova senha é diferente da confirmação de senha.'
                ], 401);
            }

            if ($user->primeiroAcesso) {
                $user->primeiroAcesso = false;
            }

            $user->password = Hash::make($request->senhaNova);
            $user->save();

            return response([
                'message' => 'Alterado com sucesso.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }
}
