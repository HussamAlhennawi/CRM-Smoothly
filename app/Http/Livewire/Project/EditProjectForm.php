<?php

namespace App\Http\Livewire\Project;

use App\Http\Requests\ProjectRequest;
use App\Models\Client;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;
use Livewire\Redirector;

class EditProjectForm extends Component
{
    use AuthorizesRequests;

    public Project $project;

    public $title;
    public $description;
    public $deadline_at;
    public $client;
    public $status;

    #[NoReturn] public function mount(Project $project)
    {
        $this->project = $project;

        $this->title = $project->title;
        $this->description = $project->description;
        $this->deadline_at = $project->deadline_at;
        $this->client = $project->client_id;
        $this->status = $project->status;
    }

    /**
     * @throws AuthorizationException
     */
    public function update(ProjectService $projectService): Redirector
    {
        $this->authorize('update', $this->project);

        $validatedData = $this->validate((new ProjectRequest())->rules());

        $projectService->update($validatedData, $this->project);

        session()->flash('project-updated');
        return redirect()->route('projects.index');
    }

    public function render()
    {
        $clients = Client::all();
        $statuses = Project::STATUS;

        return view('livewire.project.edit-project-form', compact('clients', 'statuses'));
    }
}
