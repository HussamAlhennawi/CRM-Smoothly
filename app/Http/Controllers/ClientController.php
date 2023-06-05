<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Client;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Project;
use App\Services\ClientService;
use App\Services\UserService;
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

    public function index(): Factory|View|Application
    {
        $clients = $this->clientService->index();

        return view('clients.index')->with(['clients' => $clients]);
    }

    public function create(): View
    {
        return view('clients.create');
    }

    public function store(ClientRequest $clientRequest): RedirectResponse
    {
        $this->clientService->store($clientRequest);

        return redirect()->route('clients.index');

    }
}
