<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Academico;

class AcademicoTCCRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'academico_id' => 'required',
            'semestre_id' => 'required',
            'tema' => 'required|min:15|max:10000',
            'problema' => 'required|min:15|max:10000',
            'objetivo_especifico' => 'required|min:15|max:10000',
            'objetivo_geral' => 'required|min:15|max:10000',
            'justificativa' => 'required|min:15|max:10000',
            'metodologia' => 'required|min:15|max:10000',
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
            'min' => 'O campo :attribute deve ter no mínimo 15 caracteres.',
            'max' => 'O campo :attribute deve ter no máximo 10000 caracteres.',
        ];
    }
    // public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    // {
    //     dd($validator->errors());
    // }
}
