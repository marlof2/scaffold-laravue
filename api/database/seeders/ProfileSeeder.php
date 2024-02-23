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
        // $profiles = [
        //     [
        //         'name' => 'ADMINISTRADOR',
        //         "descricao" => 'Acesso total ao sistema',
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        //     ]
        // ];

        Profile::firstOrCreate(
            [
                'name' => 'ADMINISTRADOR',
                "descricao" => 'Acesso total ao sistema',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }
}
