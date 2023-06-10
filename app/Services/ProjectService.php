<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{

    public function index(): Collection
    {
        $projects = Project::all();

        return $projects;
    }

    public function store(array $validatedData) {

        $project = Project::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'deadline_at' => $validatedData['deadline_at'],
            'client_id' => $validatedData['client'],
        ]);

        return $project;
    }

    public function update(array $validatedData, Project $project): void
    {

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
