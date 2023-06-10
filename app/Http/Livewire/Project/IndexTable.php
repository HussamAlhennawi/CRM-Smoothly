<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class IndexTable extends Component
{
    use AuthorizesRequests, WithPagination;

    public $search = '';

    protected $queryString = ['search'];


    /**
     * @throws AuthorizationException
     */
    public function destroy(ProjectService $projectService, Project $project): void
    {
        $this->authorize('destroy', $project);
        $projectService->destroy($project);
    }


    /**
     * @throws AuthorizationException
     */
    public function render()
    {
        $projects = (new ProjectService())->index($this->search);

        return view('livewire.project.index-table')->with(['projects' => $projects]);
    }
}
