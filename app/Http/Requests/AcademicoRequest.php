<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Academico;
use Illuminate\Support\Facades\Auth;

class AcademicoRequest extends FormRequest
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
            // 'name' => 'required|min:10|max:60',
            // 'email' => 'required|min:16|max:40|email',
            'password' => 'required',//['required', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            // 'matricula' => 'required|digits:9',
            'modalidade' => 'required',
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
            // 'matricula.digits' => 'O número de matrícula deve ter 7 caracteres numéricos.',

        ];
    }
}
