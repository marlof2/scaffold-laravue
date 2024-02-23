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
            //dashboard
            // [
            //     'name' => 'Dashborad',
            //     'slug' => 'dashborad',
            //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            // ],


            /*
            |--------------------------------------------------------------------------
            | Abilities for user
            |--------------------------------------------------------------------------
            */
            [
                'name' => 'Listar usuários',
                'slug' => 'user_list',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Seleciona usuários',
                'slug' => 'user_list_by_id',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Cadastrar usuário',
                'slug' => 'user_insert',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Editar usuário',
                'slug' => 'user_edit',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Deletar usuário',
                'slug' => 'user_delete',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Trocar de senha',
                'slug' => 'user_change_password',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],


            /*
            |--------------------------------------------------------------------------
            | Abilities for profile
            |--------------------------------------------------------------------------
            */
            [
                'name' => 'Listar perfis',
                'slug' => 'profile_list',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Listar habilidade por perfl',
                'slug' => 'profile_list_ability',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Cadastrar perfil',
                'slug' => 'profile_inset',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Editar perfil',
                'slug' => 'profile_edit',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Deletar perfil',
                'slug' => 'profile_delete',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Adicionar Permissões ao Perfil',
                'slug' => 'profile_add_permisao',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],


        ];

        foreach ($abilities as $key => $value) {
            Ability::firstOrCreate([
                'name' => $value['name'],
                'slug' => $value['slug'],
            ]);
        }

    }
}
