<?php

namespace App\Http\Requests;

use App\Models\Orientador;
use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        switch ($this->method())
        {
            case 'POST':
                return [
                    'name' => 'required|max:125|min:3|unique:permissions,name',
                    'description' => 'required|max:125|min:3',
                    'guard_name' => 'required|max:125|min:2'
                ];
                break;
            case 'PUT':
                    return [
                        'name' => 'required|max:125|min:3',
                        'description' => 'required|max:125|min:3',
                        'guard_name' => 'required|max:125|min:3'
                    ];
                    break;
        }

    }

    /**
     * Get the messages array.
     *
     */
    public function messages(): array
    {
        return [
                'required' => 'O campo :attribute deve ser preenchido.',
                'max' => 'O campo deve ser preenchido por no máximo 125 caracteres.',
                'min' => 'O campo deve ser preenchido por no mínimo 3 caracteres.'
            ];
    }
}

