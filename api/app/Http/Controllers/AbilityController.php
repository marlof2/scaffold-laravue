<?php

namespace App\Http\Controllers;

use App\Services\AbilityService;
use Illuminate\Http\Request;

class AbilityController extends Controller
{
    private $abilityService;

    function __construct(AbilityService $abilityService)
    {
        $this->abilityService = $abilityService;
    }

    public function index(Request $request)
    {
        return $this->abilityService->index($request);
    }

}
