<?php

namespace App\Services;

use App\Models\Ability;

class AbilityService
{

    private $ability;

    function __construct(Ability $abilityModel)
    {
        $this->ability = $abilityModel;
    }

    public function index($request)
    {
       return $this->ability->orderBy('slug', 'asc')->get();
    }
}
