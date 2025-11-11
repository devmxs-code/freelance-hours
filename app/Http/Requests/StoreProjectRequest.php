<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'ends_at' => ['required', 'date', 'after:now'],
            'status' => ['sometimes', 'string', 'in:open,closed'],
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
            'ends_at.after' => 'A data de término deve ser no futuro.',
            'tech_stack.required' => 'A stack tecnológica é obrigatória.',
            'tech_stack.min' => 'Selecione pelo menos uma tecnologia.',
            'categories.array' => 'As categorias devem ser um array.',
            'categories.*.exists' => 'Uma ou mais categorias selecionadas são inválidas.',
        ];
    }
}

