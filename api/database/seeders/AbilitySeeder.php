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
            [
                'name' => 'Dashborad',
                'slug' => 'dashborad',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],


            /*
            |--------------------------------------------------------------------------
            | Abilities for user
            |--------------------------------------------------------------------------
            */
            [
                'name' => 'Listar usuários',
                'slug' => 'user_list_all',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Seleciona usuários',
                'slug' => 'user_by_id',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Cadastrar usuário',
                'slug' => 'user_create',
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


            /*
            |--------------------------------------------------------------------------
            | Abilities for profile
            |--------------------------------------------------------------------------
            */
            [
                'name' => 'Listar perfis',
                'slug' => 'list_perfil',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Listar habilidade por perfl',
                'slug' => 'list_ability_perfil',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Cadastrar perfil',
                'slug' => 'cad_perfil',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Editar perfil',
                'slug' => 'edit_perfil',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Deletar perfil',
                'slug' => 'del_perfil',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            /*
            |--------------------------------------------------------------------------
            | Abilities for abilities
            |--------------------------------------------------------------------------
            */
            [
                'name' => 'Listar habilidade',
                'slug' => 'list_habilidade',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Cadastrar habilidade',
                'slug' => 'cad_habilidade',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Editar habilidade',
                'slug' => 'edit_habilidade',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Deletar habilidade',
                'slug' => 'del_habilidade',
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
