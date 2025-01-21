<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Orientador;

class AdminStoreOrientadorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // if(!Orientador::where('admin_id', auth()->guard('admin')->user()->id)->exists() && auth()->guard('admin')->check()){
        //     return true;
        // }
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
            'nome' => 'required|min:7',
            'email' => 'required|email',
            'masp' => ['required', 'regex:/^\d{7,8}$|^\d{7}-\d$/', 'unique:orientadores,masp'],
        ];
    }
        /**
     * Get the messages array.
     *
     */
    public function messages(): array
    {
        $orientadorExistente = Orientador::where('masp', request()->input('masp'))->exists() ? Orientador::where('masp', request()->input('masp'))->first()->AdminTrashed->nome : null;
        return [
            'required' => 'O campo :attribute deve ser preenchido.',
            'nome.min' => 'O campo nome deve ter no mínimo 7 caracteres.',
            'email.email' => 'O campo email deve ser preenchido com um endereço de email.',
            'masp.unique' => 'O MASP já está cadastrado no orientador: ' . $orientadorExistente,
            'masp.regex' => 'O MASP deve ter um destes formatos: 1234567, 12345678 ou 1234567-8.',
        ];
    }
}
