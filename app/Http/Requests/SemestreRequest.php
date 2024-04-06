<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Orientador;
use Carbon\Carbon;

class SemestreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(!Orientador::where('email', auth()->guard('admin')->user()->email)->exists() && auth()->guard('admin')->check()){
            return true;
        }
        return false;
    }

    /**
     * Define um mínimo de X meses entre data_inicio e data_fim
     */
    private function gapMinimo($data_inicio, $meses)
    {
        Carbon::setLocale('pt_BR');
        $gap = Carbon::parse($data_inicio)->addMonths($meses);
        // $gap = Carbon::createFromFormat('D/MM/YYYY', $data_inicio);
        // dd($gap);
        return 'after:'.$gap;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     *
     * OBS.: Eu tinha colocado a regra 'date' nessas datas, mas tava dando problema, e tirei // |date
     */
    public function rules(): array
    {
        // dd(request()->all());
        // dd(Carbon::parse(request()->input('data_fim', 'd/m/Y')));
        // $data_fim = Carbon::createFromFormat('DD-MM-YYYY', request()->input('data_fim'))->format('d/m/y');
        // dd($data_fim);
        $anoAtual = Carbon::now()->year;
        $anoSeguinte = $anoAtual + 1;


        return [
            'ano' => 'required|integer|min:' . $anoAtual . '|max:' . $anoSeguinte,
            'numero' => 'required|integer|min:1|max:2',
            'data_inicio' => 'required|before:data_fim', //. $data_fim,
            'data_fim' => [
                'required',
                $this->gapMinimo(request()->input('data_inicio'), 4)],
            'limite_doc_estagio' => 'required|before:data_fim', //. $data_fim,
            'limite_orientacao' => 'required|before:data_fim', //. $data_fim,
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
            'ano.integer' => 'O campo ano deve ser um número inteiro.',
            'ano.min' => 'O campo ano deve ser maior em 1 ano ou igual a :min.',
            'ano.max' => 'O campo ano deve ser menor em 1 ano ou igual a :max.',
            'numero.integer' => 'O campo número deve ser um número inteiro.',
            'data_inicio.date' => 'O campo data de início deve ser uma data válida.',
            'data_inicio.before' => 'A data de início deve ser uma data anterior a data de finalização do semestre.',
            'data_fim.date' => 'O campo data de término deve ser uma data válida.',
            'data_fim.after' => 'A data de término deve ser igual ou posterior no mínimo 5 meses após a data de início.',
            'limite_doc_estagio.date' => 'O campo de data-limite para entrega da documentação de estágio deve ser uma data válida.',
            'limite_doc_estagio.before' => 'A data-limite para entrega da documentação de estágio deve ser uma data anterior à data de finalização do semestre.',
            'limite_orientacao.date' => 'O campo de data-limite para entrega da documentação de orientação deve ser uma data válida.',
            'limite_orientacao.before' => 'A data-limite para entrega da documentação de orientação deve ser uma data anterior à data de finalização do semestre.',
        ];
    }
}
