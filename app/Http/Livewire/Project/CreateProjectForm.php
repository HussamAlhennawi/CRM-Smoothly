<?php

namespace App\Http\Livewire\Project;

use App\Http\Requests\ProjectRequest;
use App\Models\Client;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Redirector;
use Livewire\Component;

class CreateProjectForm extends Component
{
    use AuthorizesRequests;

    public $title;
    public $description;
    public $deadline_at;
    public $client;
    public $status; // added just for validation

    /**
     * @throws AuthorizationException
     */
    public function store(ProjectService $projectService): Redirector
    {

        $this->authorize('store', Project::class);

        $validatedData = $this->validate((new ProjectRequest())->rules());

        $projectService->store($validatedData);

        session()->flash('project-added');
        return redirect()->route('projects.index');
    }

    public function render()
    {
        $clients = Client::all();

        return view('livewire.project.create-project-form')->with(['clients' => $clients]);
    }
}
