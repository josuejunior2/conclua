<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'name' => 'required|min:10|max:60',
            'email' => 'required|min:16|max:40|email',
            'masp' => 'required|digits:7',
            'formacao_id' => 'required',
            'area_id' => 'required',
            'enderecoLattes' => 'required|min:38|max:38',
            'enderecoOrcid' => 'required|min:37|max:37',
            'disponibilidade' => 'required',
            'matricula' => 'required|digits:9'
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
            'name.min' => 'O campo nome deve ter no mínimo 10 caracteres.',
            'name.max' => 'O campo nome deve ter no máximo 60 caracteres.',
            'email.min' => 'O campo email deve ter no mínimo 16 caracteres.',
            'email.max' => 'O campo email deve ter no máximo 40 caracteres.',
            'email.email' => 'O campo email deve ser preenchido com um endereço de email.',
            'masp.digits' => 'O campo MASP deve ter 7 caracteres numéricos.',
            'matricula.digits' => 'O número de matrícula deve ter 7 caracteres numéricos.',
            'enderecoLattes.min' => 'O link deve ter 38 caracteres.',
            'enderecoLattes.max' => 'O link deve ter 38 caracteres.',
            'enderecoOrcid.min' => 'O link deve ter 37 caracteres.',
            'enderecoOrcid.max' => 'O link deve ter 37 caracteres.',
        ];
    }
}
