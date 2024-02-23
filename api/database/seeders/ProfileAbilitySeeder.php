<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\ProfileAbility;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProfileAbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        |--------------------------------------------------------------------------
        | The admin profile have all the skills
        |--------------------------------------------------------------------------
        */
        $idAbilitys = Ability::all('id');
        foreach ($idAbilitys as $idAbility) {
            ProfileAbility::firstOrCreate([
                'profile_id' => 1,
                'ability_id' => $idAbility->id,
            ]);
        }
    }
}
