<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Models\Orientador;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(!Orientador::where('admin_id', auth()->guard('admin')->user()->id)->exists() && auth()->guard('admin')->check()){
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
            'nome' => 'required|min:5',
            'email' => 'required|email',
            'password' => ['nullable', 'string', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            'perfil' => 'required',
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
            'nome.min' => 'O campo nome deve ter no mínimo 5 caracteres.',
            'email.email' => 'O campo email deve ser preenchido com um endereço de email.',
        ];
    }
}
