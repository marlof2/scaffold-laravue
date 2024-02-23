<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'name' => 'Marlo',
            'sobrenome' => 'Marques da Silva Filho',
            'profile_id' => 1,
            'cpf' => '03296244581',
            'email' => 'marlosilva.f2@gmail.com',
            'primeiro_acesso' => false,
            'password' => Hash::make('123')
        ]);

    }
}
