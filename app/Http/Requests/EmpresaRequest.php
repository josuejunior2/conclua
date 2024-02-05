<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Academico;

class EmpresaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Academico::where('email', auth()->user()->email)->exists()){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * Para fazer a regra do CNPJ ficou complicado. Segundo o gpteco é assim:
     *
     *  ^[0-9]+ - Corresponde a um ou mais números no início.
     *  (\.[0-9]+){0,2} - Permite zero a duas ocorrências de um ponto seguido por um ou mais números.
     *  \/ - Corresponde a uma barra para a direita.
     *  [0-9]+ - Corresponde a um ou mais números.
     *  - - Corresponde a um traço.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cnpj' => ['required', 'regex:/^[0-9]+(\.[0-9]+){0,2}\/[0-9]+-[0-9]+$/'],
            'name' => 'required|min:10|max:60',
            'supervisor' => 'required|min:10|max:60',
            'email' => 'required|email',
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
            'name.required' => 'O campo nome deve ser preenchido',
            'name.min' => 'O campo nome deve ter no mínimo 10 caracteres.',
            'name.max' => 'O campo nome deve ter no máximo 60 caracteres.',
            'supervisor.min' => 'O campo nome deve ter no mínimo 10 caracteres.',
            'supervisor.max' => 'O campo nome deve ter no máximo 60 caracteres.',
            'email.email' => 'O campo email deve ser preenchido com um endereço de email.',
            'cnpj.regex' => 'O campo CNPJ deve ter 14 caracteres numéricos, 2 pontos, 1 barra e 1 hífen.',
        ];
    }
    // public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    // {
    //     dd($validator->errors());
    // }
}
