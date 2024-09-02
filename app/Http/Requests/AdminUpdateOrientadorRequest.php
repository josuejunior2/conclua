<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Orientador;
use Illuminate\Validation\Rule;

class AdminUpdateOrientadorRequest extends FormRequest
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
            'nome' => 'required|min:7',
            'email' => 'required|email',
            'masp' => [
                'required',
                'digits:7',
                Rule::unique('orientadores', 'masp')->ignore(request()->orientador_id)
            ]
        ];
    }
        /**
     * Get the messages array.
     *
     */
    public function messages(): array
    {
        $orientadorExistente = Orientador::where('masp', request()->input('masp'))->exists() ? Orientador::where('masp', request()->input('masp'))->first()->Admin->nome : null;
        return [
            'required' => 'O campo :attribute deve ser preenchido.',
            'nome.min' => 'O campo nome deve ter no mínimo 7 caracteres.',
            'email.email' => 'O campo email deve ser preenchido com um endereço de email.',
            'masp.digits' => 'O número de matrícula deve ter 9 caracteres numéricos.',
            'masp.unique' => 'O número de matrícula já está cadastrado no acadêmico: ' . $orientadorExistente,
        ];
    }
}
