<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrientadorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(auth()->guard('admin')->check()){ // + alguma verificação?
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
            'enderecoLattes' => 'required|min:38|max:38',
            'enderecoOrcid' => 'required|min:37|max:37',
            'disponibilidade' => 'required',
            'orientadorGeral_id' => 'required',
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
            'enderecoLattes.min' => 'O link deve ter 38 caracteres.',
            'enderecoLattes.max' => 'O link deve ter 38 caracteres.',
            'enderecoOrcid.min' => 'O link deve ter 37 caracteres.',
            'enderecoOrcid.max' => 'O link deve ter 37 caracteres.',
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        dd($validator->errors());
    }
}
