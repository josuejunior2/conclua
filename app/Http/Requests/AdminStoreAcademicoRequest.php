<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Orientador;
use App\Models\Academico;

class AdminStoreAcademicoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // if(!Orientador::where('admin_id', auth()->guard('admin')->user()->id)->exists() && auth()->guard('admin')->check()){
        //     return true;
        // }
        // return false;
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
            'matricula' => 'required|digits:9|unique:academicos',
        ];
    }
        /**
     * Get the messages array.
     *
     */
    public function messages(): array
    {
        $academicoExistente = Academico::where('matricula', request()->input('matricula'))->exists() ? Academico::where('matricula', request()->input('matricula'))->first()->UserTrashed->nome : null;
        return [
            'required' => 'O campo :attribute deve ser preenchido.',
            'nome.min' => 'O campo nome deve ter no mínimo 7 caracteres.',
            'email.email' => 'O campo email deve ser preenchido com um endereço de email.',
            'matricula.digits' => 'O número de matrícula deve ter 9 caracteres numéricos.',
            'matricula.unique' => 'O número de matrícula já está cadastrado no acadêmico: ' . $academicoExistente,
        ];
    }
}
