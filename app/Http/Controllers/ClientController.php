<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Client;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Project;
use App\Services\ClientService;
use App\Services\UserService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ClientController extends Controller
{

    public ClientService $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }


    /**
     * @throws AuthorizationException
     */
    public function index(): Factory|View|Application
    {
        $this->authorize('viewAny', Client::class);

        $clients = $this->clientService->index();

        return view('clients.index')->with(['clients' => $clients]);
    }


    /**
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('store', Client::class);

        return view('clients.create');
    }



    public function store(ClientRequest $clientRequest): RedirectResponse
    {
        $this->clientService->store($clientRequest);

        return redirect()->route('clients.index');

    }


    /**
     * @throws AuthorizationException
     */
    public function edit(Client $client): View
    {
        $this->authorize('update', $client);

        return view('clients.edit')->with(['client' => $client]);
    }



    public function update(ClientRequest $clientRequest, Client $client): RedirectResponse
    {
        $this->clientService->update($clientRequest, $client);

        return redirect()->route('clients.index');
    }



    public function destroy(Client $client): RedirectResponse
    {
        $this->authorize('delete', $client);

        $this->clientService->destroy($client);

        return redirect()->route('clients.index');
    }

}
