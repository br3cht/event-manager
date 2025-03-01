<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string',
            'descricao' => 'nullable|string',
            'localizacao' => 'required|string',
            'capacidade_maxima' => 'required|integer',
            'horario_inicio' => 'required|date',
            'horario_final' => 'required|date',
            'status' => 'required|string',
        ];
    }
}
