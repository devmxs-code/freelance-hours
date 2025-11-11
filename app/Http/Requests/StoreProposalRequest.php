<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProposalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255'],
            'hours' => ['required', 'integer', 'min:1', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ser um endereço válido.',
            'email.max' => 'O email não pode ter mais de 255 caracteres.',
            'hours.required' => 'O número de horas é obrigatório.',
            'hours.integer' => 'O número de horas deve ser um número inteiro.',
            'hours.min' => 'O número de horas deve ser no mínimo 1.',
            'hours.max' => 'O número de horas não pode ser maior que 1000.',
        ];
    }
}

