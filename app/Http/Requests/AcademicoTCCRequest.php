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
            'tema' => 'required|min:15|max:60',
            'resumo' => 'required|min:20|max:750',
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
            'tema.min' => 'O campo tema deve ter no mínimo 15 caracteres.',
            'tema.max' => 'O campo tema deve ter no máximo 60 caracteres.',
            'resumo.min' => 'O campo resumo deve ter no mínimo 20 caracteres.',
            'resumo.max' => 'O campo resumo deve ter no máximo 750 caracteres.',
        ];
    }
}