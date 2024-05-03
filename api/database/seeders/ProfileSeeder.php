<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            [
                'name' => 'Administrador',
                "descricao" => 'Acesso total ao sistema',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Usuário',
                "descricao" => 'Breve descrição das permissões',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

        ];

        foreach ($profiles as $key => $value) {
            Profile::firstOrCreate([
                'name' => $value['name'],
                'descricao' => $value['descricao'],
            ]);
        }
    }
}
