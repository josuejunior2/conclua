<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Academico;

class AcademicoEstagioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Academico::where('user_id', auth()->user()->id)->exists()){
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
            'semestre_id' => 'required',
            'empresa_id' => 'required',
            'tema' => 'required|min:7',
            'setor_atuacao' => 'required',
            'supervisor' => 'required',
            'email_supervisor' => 'required|email',
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
            'tema.min' => 'O campo tema deve ter no mínimo 7 caracteres.',
            'tema.min' => 'O campo tema deve ter no mínimo 7 caracteres.',
            'email_supervisor.email' => 'O campo email do supervisor deve ser preenchido com um endereço email.',
        ];
    }
    // public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    // {
    //     dd($validator->errors());
    // }
}
