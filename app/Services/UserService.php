<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Jobs\SendNewUserMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class UserService
{

    public function index(): Collection
    {
        $users = User::all();

        return $users;
    }

    public function ValidateCreationFirstStep(Request $request): JsonResponse
    {

        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        } else {
            return response()->json('OK');
        }
    }

    public function store($userRequest) {

        $validatedData = $userRequest->validated();

        $user = null;

        DB::transaction(function () use($validatedData, &$user) {
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $user->assignRole($validatedData['role']);

            isset($validatedData['permissions'])
                ?? $user->givePermissionTo($validatedData['permissions']);

            isset($validatedData['projects'])
                ?? $user->assignedProjects()->attach($validatedData['projects']);
        });


        if ($user) {
            SendNewUserMail::dispatch($user);
        }

            // send email to user
            // email verification

    }

}
