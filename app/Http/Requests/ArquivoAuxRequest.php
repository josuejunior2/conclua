<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Orientador;

class ArquivoAuxRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Orientador::where('admin_id', auth()->guard('admin')->user()->id)->exists()){
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
            'arquivos_aux.*' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png,bmp,gif,svg,xlsx,csv|max:2048',
        ];
    }
}