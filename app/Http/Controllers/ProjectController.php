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

        return view('projects.index');
    }



    /**
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('store', Project::class);

        return view('projects.create');
    }



    /**
     * @throws AuthorizationException
     */
    public function edit(Project $project): View
    {
        $this->authorize('update', $project);

        return view('projects.edit')->with(['project' => $project]);
    }



//    /**
//     * @throws AuthorizationException
//     */
//    public function destroy(Project $project): RedirectResponse
//    {
//        $this->authorize('destroy', $project);
//
//        $this->projectService->destroy($project);
//
//        return redirect()->route('projects.index');
//    }
}
