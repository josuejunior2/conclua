<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Semestre;

class ModeloDocumentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        if (empty($this->input('hora')) && !empty($this->input('data_limite'))) {
            $this->merge(['hora' => null, 'data_limite' => $this->input('data_limite').' 23:59:59']);
        } else if (!empty($this->input('data_limite'))) {
            $this->merge(['data_limite' => $this->input('data_limite').' '.$this->input('hora')]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $data_fim_semestre = Semestre::where('id', session('semestre_id'))->first()->data_fim;
        
        return [
            'nome' => 'required',
            'descricao' => 'nullable',
            'modalidade' => 'nullable',
            'arquivos.*' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png,bmp,gif,svg,xlsx,csv',
            'data_limite' => 'required|before:'.$data_fim_semestre,
            'hora' => ['nullable', 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d$/'],
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
                'arquivos.mimes' => 'Os arquivos podem estar nas extensões pdf,doc,docx,jpg,jpeg,png,bmp,gif,svg,xlsx,csv.',
                'data_limite.before' => 'A data de limite deve ser anterior à data de finalização do semestre.',
                'hora.regex' => 'Coloque uma hora válida.',
            ];
    }
}
