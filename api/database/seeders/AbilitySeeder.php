<?php

namespace Database\Seeders;

use App\Models\Ability;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $abilities = [
           [
                'name' => 'Listar usuários',
                'slug' => 'user_list',
                'functionality' => 'usuario',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Selecionar usuários',
                'slug' => 'user_by_id',
                'functionality' => 'usuario',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Cadastrar usuário',
                'slug' => 'user_insert',
                'functionality' => 'usuario',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),

            ],
            [
                'name' => 'Editar usuário',
                'slug' => 'user_edit',
                'functionality' => 'usuario',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Deletar usuário',
                'slug' => 'user_delete',
                'functionality' => 'usuario',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Trocar de senha',
                'slug' => 'user_change_password',
                'functionality' => 'usuario',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Resetar senha usuário',
                'slug' => 'user_reset_senha',
                'functionality' => 'usuario',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],


            /*
            |--------------------------------------------------------------------------
            | Abilities for profile
            |--------------------------------------------------------------------------
            */
            [
                'name' => 'Listar perfis',
                'slug' => 'profile_list',
                'functionality' => 'perfil',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Listar habilidade por perfl',
                'slug' => 'profile_list_ability',
                'functionality' => 'perfil',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Cadastrar perfil',
                'slug' => 'profile_insert',
                'functionality' => 'perfil',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Editar perfil',
                'slug' => 'profile_edit',
                'functionality' => 'perfil',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Selecionar perfil',
                'slug' => 'profile_by_id',
                'functionality' => 'perfil',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Deletar perfil',
                'slug' => 'profile_delete',
                'functionality' => 'perfil',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Adicionar Permissões ao Perfil',
                'slug' => 'profile_add_permisao',
                'functionality' => 'perfil',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],


        ];

        foreach ($abilities as $key => $value) {
            Ability::firstOrCreate([
                'name' => $value['name'],
                'slug' => $value['slug'],
                'functionality' => $value['functionality'],
            ]);
        }

    }
}
