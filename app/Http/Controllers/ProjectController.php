<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }


    /**
     * @throws AuthorizationException
     */
    public function index(): Factory|View|Application
    {
        $this->authorize('viewAny', Project::class);

        $projects = $this->projectService->index();

        return view('projects.index')->with(['projects' => $projects]);
    }


    /**
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('store', Project::class);

        return view('projects.create');
    }



    public function store(ProjectRequest $projectRequest): RedirectResponse
    {
        $this->projectService->store($projectRequest);

        return redirect()->route('projects.index');

    }


    /**
     * @throws AuthorizationException
     */
    public function edit(Project $project): View
    {
        $this->authorize('update', $project);

        return view('projects.edit')->with(['project' => $project]);
    }



    public function update(ProjectRequest $projectRequest, Project $project): RedirectResponse
    {
        $this->projectService->update($projectRequest, $project);

        return redirect()->route('projects.index');
    }



    public function destroy(Project $project): RedirectResponse
    {
        $this->authorize('delete', $project);

        $this->projectService->destroy($project);

        return redirect()->route('projects.index');
    }
}
