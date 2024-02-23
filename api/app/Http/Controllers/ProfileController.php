<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    private $profileService;

    function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function index(Request $request)
    {
        return $this->profileService->index($request);
    }

    protected function store(Request $request)
    {
        return $this->profileService->store($request);
    }

    protected function update(Request $request, $id)
    {
        return $this->profileService->update($request, $id);
    }

    protected function destroy($id)
    {
        return $this->profileService->destroy($id);
    }

    public function getAbilities($id)
    {
        return $this->profileService->getAbilities($id);
    }

    protected function addPermissions(Request $request, $id)
    {
        return $this->profileService->addPermissions($id, $request);
    }
}
