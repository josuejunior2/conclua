<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserStoreRequest extends FormRequest
{
    /**
     * The URI that users should be redirected to if validation fails.
     *
     * @var string
     */
    protected $redirect = '/home';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // alguma verificação?
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
            'nome' => 'required|min:10|max:60',
            'email' => 'required|email',
            'password' => 'required',//['required', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
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
            'name.required' => 'O campo nome deve ser preenchido',
            'name.min' => 'O campo nome deve ter no mínimo 10 caracteres.',
            'name.max' => 'O campo nome deve ter no máximo 60 caracteres.',
            'email.email' => 'O campo email deve ser preenchido com um endereço de email.',
        ];
    }

    // public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    // {
    //     dd($validator->errors());
    // }
}
