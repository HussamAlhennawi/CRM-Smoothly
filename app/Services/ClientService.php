<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Jobs\SendNewUserMail;
use App\Models\Client;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class ClientService
{

    public function index(): Collection
    {
        $clients = Client::all();

        return $clients;
    }

    public function store($clientRequest) {

        $validatedData = $clientRequest->validated();

            $client = Client::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'mobile' => $validatedData['mobile'],
                'address' => $validatedData['address'],
            ]);

            return $client;
    }

    public function update($clientRequest, $client): void
    {
        $validatedData = $clientRequest->validated();

        $client->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'mobile' => $validatedData['mobile'],
            'address' => $validatedData['address'],
        ]);
    }

    public function destroy(Client $client): void
    {
        $client->delete();
    }

}
