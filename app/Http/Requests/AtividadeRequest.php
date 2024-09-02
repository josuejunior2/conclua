<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Semestre;
use App\Models\Orientador;

class AtividadeRequest extends FormRequest
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
            'titulo' => 'required|string|max:256',
            'descricao' => 'nullable',
            'data_limite' => 'required|before:'.$data_fim_semestre,
            // 'data_entrega' => 'nullable|before:'.$data_fim_semestre,
            'orientacao_id' => 'required|exists:orientacoes,id',
            'hora' => ['nullable', 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d$/'],
            'arquivos_aux.*' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png,bmp,gif,svg,xlsx,csv|max:2048',
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
                'max' => 'O campo deve ser preenchido por no máximo 256 caracteres.',
                'orientacao_id.exists' => 'O acadêmico e o orientador devem estar em orientação no semestre.',
                'data_entrega.before' => 'A data de entrega deve ser anterior à data de finalização do semestre.',
                'hora.regex' => 'Coloque uma hora válida.'
            ];
    }
}
