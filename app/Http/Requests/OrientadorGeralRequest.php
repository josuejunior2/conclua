<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\OrientadorGeral;
use Illuminate\Support\Facades\Auth;

class OrientadorGeralRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(OrientadorGeral::where('email', auth()->user()->email)->exists()){
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
            // 'name' => 'required|min:10|max:60',
            // 'email' => 'required|min:16|max:40|email',
            // 'masp' => 'required|digits:7',
            'password' => 'required',//['required', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            'formacao_id' => 'required',
            'area_id' => 'required',
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
            'password.required' => 'O campo senha deve ser preenchido',

            // 'name.min' => 'O campo nome deve ter no mínimo 10 caracteres.',
            // 'name.max' => 'O campo nome deve ter no máximo 60 caracteres.',
            // 'email.min' => 'O campo email deve ter no mínimo 16 caracteres.',
            // 'email.max' => 'O campo email deve ter no máximo 40 caracteres.',
            // 'email.email' => 'O campo email deve ser preenchido com um endereço de email.',
            // 'masp.digits' => 'O campo MASP deve ter 7 caracteres numéricos.',

        ];
    }
    // public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    // {
    //     dd($validator->errors());
    // }
}
