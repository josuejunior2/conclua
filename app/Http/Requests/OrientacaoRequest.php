<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Orientador;

class OrientacaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Orientador::where('email', auth()->guard('admin')->user()->email)->exists() && auth()->guard('admin')->check()){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'academico_id' => 'required',
            'orientador_id' => 'required',
            'semestre_id' => 'required',
            'data_vinculacao' => 'nullable',
            'solicitacao_id' => 'nullable',
            'modalidade' => 'nullable'
        ];
    }
 /**
     * Get the messages array.
     *
     */
    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido.',
        ];
    }
}
