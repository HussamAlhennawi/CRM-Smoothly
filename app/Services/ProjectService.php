<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{

    public function index(): Collection
    {
        $projects = Project::all();

        return $projects;
    }

    public function store($projectRequest) {

        $validatedData = $projectRequest->validated();

        $project = Client::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'deadline_at' => $validatedData['deadline_at'],
            'status' => $validatedData['status'],
            'client_id' => $validatedData['client'],
        ]);

        return $project;
    }

    public function update($projectRequest, $project): void
    {
        $validatedData = $projectRequest->validated();

        $project->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'deadline_at' => $validatedData['deadline_at'],
            'status' => $validatedData['status'],
            'client_id' => $validatedData['client'],
        ]);
    }

    public function destroy(Project $project): void
    {
        $project->delete();
    }
}
