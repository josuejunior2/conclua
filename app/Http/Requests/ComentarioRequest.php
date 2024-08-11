<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComentarioRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'atividade_id' => 'required',
                    'texto' => 'required|string',
                    'orientador_id' => 'nullable',
                    'academico_id' => 'nullable',
                    'comentario_id' => 'nullable',
                ];
                break;
            case 'PUT':
                return [
                    'texto' => 'required|string',
                ];
                break;
        }
    }
}
