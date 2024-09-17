<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Academico;

class ArquivoSubmissaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Academico::where('user_id', auth()->guard('web')->user()->id)->exists()){
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
            'arquivos_submissao.*' => 'required|mimes:pdf,odf,jpg,jpeg,png,bmp,gif,svg|max:2048',
        ];
    }
}
