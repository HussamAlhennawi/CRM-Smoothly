<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->routeIs('clients.store')
            ? auth()->user()->can('store', Project::class)
            : auth()->user()->can('update', Project::find(request()->segment(2)));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'deadline_at' => ['required', 'date', 'after:today'],
            'status' => ['required', 'integer', Rule::in(Project::STATUS)],
            'client_id' => ['required', 'exists:clients,id'],
        ];
    }
}
