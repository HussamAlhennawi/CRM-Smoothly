<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', 'min:7'],
            'description' => ['required', 'string'],
            'deadline_at' => ['required', 'date', 'after:today'],
            'status' => Rule::when(request()->route()->name === 'project.edit-project-form', ['required', 'integer', Rule::in(Project::STATUS)]),
            'client' => ['required', 'exists:clients,id'],
        ];
    }
}


