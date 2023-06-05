<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Project;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): Factory|View|Application
    {
        $users = $this->userService->index();

        return view('users.index')->with(['users' => $users]);
    }

    public function create(): View
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $projects = Project::all();

        return view('users.create')->with([
            'roles' => $roles,
            'permissions' => $permissions,
            'projects' => $projects
        ]);
    }

    public function store(UserRequest $userRequest): RedirectResponse
    {
        $this->userService->store($userRequest);

        return redirect()->route('users.index');

    }

    public function validateFirstStep(Request $request): JsonResponse
    {
        return $this->userService->ValidateCreationFirstStep($request);
    }


}
