<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Verificar se o usuário é o criador do projeto ou admin
        $projectId = $this->route('id');
        $project = \App\Models\Project::find($projectId);
        $user = auth()->user();
        
        return $project && ($project->created_by === $user->id || $user->isAdmin());
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'ends_at' => ['required', 'date'],
            'status' => ['required', 'string', 'in:open,closed'],
            'tech_stack' => ['required', 'array', 'min:1'],
            'tech_stack.*' => ['string', 'max:50'],
            'categories' => ['sometimes', 'array'],
            'categories.*' => ['exists:categories,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título é obrigatório.',
            'title.max' => 'O título não pode ter mais de 255 caracteres.',
            'description.required' => 'A descrição é obrigatória.',
            'ends_at.required' => 'A data de término é obrigatória.',
            'ends_at.date' => 'A data de término deve ser uma data válida.',
            'status.required' => 'O status é obrigatório.',
            'status.in' => 'O status deve ser "open" ou "closed".',
            'tech_stack.required' => 'A stack tecnológica é obrigatória.',
            'tech_stack.min' => 'Selecione pelo menos uma tecnologia.',
        ];
    }
}

