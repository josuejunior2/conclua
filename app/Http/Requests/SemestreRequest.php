<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use App\Models\Orientador;
use App\Models\Semestre;
use Carbon\Carbon;

class SemestreRequest extends FormRequest
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
     * Checa se a data_fim de algum semestre é maior ou igual a data inicio do que está sendo criado.
     */
    private function afterDataFimAnterior($data_inicio, $ano, $periodo)
    {
        if(!empty($data_inicio) && !empty($ano) && !empty($periodo)){
            $semestreAnterior = Semestre::where('ano', $ano)->where('data_fim', '>=', $data_inicio)->whereNot('periodo', $periodo)->first();
            if(isset($semestreAnterior) && $semestreAnterior->id != request()->input('id')){
                return 'after:'.$semestreAnterior->data_fim;
            }
        }
    }

    /**
     * Define um mínimo de X meses entre data_inicio e data_fim
     */
    private function gapMinimo($data_inicio, $meses)
    {
        if(!empty($data_inicio) && !empty($meses)){
            Carbon::setLocale('pt_BR');
            $gap = Carbon::parse($data_inicio)->addMonths($meses);

            return 'after:'.$gap;
        }
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
        $anoAtual = Carbon::now()->year;
        $anoSeguinte = $anoAtual + 1;
        $ano = request()->input('ano');
        $periodo = request()->input('periodo');
        $dataInicio = request()->input('data_inicio');
        $dataFim = request()->input('data_fim');

        switch ($this->method())
        {
            case 'POST':
                return [
                    'ano' => 'required|integer|min:' . $anoAtual . '|max:' . $anoSeguinte,
                    'periodo' => [
                        'required',
                        'integer',
                        'min:1',
                        'max:3',
                        Rule::unique('semestres')->withoutTrashed()->where(fn (Builder $query) => $query->where('ano', $ano))
                    ],
                    'data_inicio' => [
                        'required',
                        'before:data_fim',
                        $this->afterDataFimAnterior($dataInicio, $ano, $periodo),
                    ],
                    'data_fim' => [
                        'required',
                        $this->gapMinimo($dataInicio, 2),
                    ],
                ];
                break;
            case 'PUT':
                    return [
                        'ano' => 'required|integer|min:' . $anoAtual . '|max:' . $anoSeguinte,
                        'periodo' => [
                            'required',
                            'integer',
                            'min:1',
                            'max:3',
                        ],
                        'data_inicio' => [
                            'required',
                            'before:data_fim',
                            $this->afterDataFimAnterior($dataInicio, $ano, $periodo),
                        ],
                        'data_fim' => [
                            'required',
                            $this->gapMinimo($dataInicio, 2),
                        ], //, 4)],
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
        $dataFimSemestreAnterior = '';
        if(!empty(request()->input('ano')) && !empty(request()->input('data_inicio')) && !empty(request()->input('periodo'))){
            $semestreAnterior = Semestre::where('ano', request()->input('ano'))->where('data_fim', '>=', request()->input('data_inicio'))->whereNot('periodo', request()->input('periodo'))->first();
            if(isset($semestreAnterior)){ $dataFimSemestreAnterior = $semestreAnterior->data_fim->format('d/m/Y'); } else { $dataFimSemestreAnterior = ''; }
        }
        return [
            'required' => 'O campo :attribute deve ser preenchido.',
            'ano.integer' => 'O campo ano deve ser um número inteiro.',
            'ano.min' => 'O campo ano deve ser maior em 1 ano ou igual a :min.',
            'ano.max' => 'O campo ano deve ser menor em 1 ano ou igual a :max.',
            'periodo.integer' => 'O campo número deve ser um número inteiro.',
            'periodo.unique' => 'Já existe um semestre '.request()->input('ano').'/'.request()->input('periodo').'.',
            'data_inicio.date' => 'O campo data de início deve ser uma data válida.',
            'data_inicio.before' => 'A data de início deve ser uma data anterior a data de finalização do semestre.',
            'data_inicio.after' => 'A data de início deve ser posterior a data de finalização do semestre passado ('.$dataFimSemestreAnterior.').',
            'data_inicio.unique' => 'Essa data de início já foi cadastrada.',
            'data_fim.unique' => 'Essa data de fim já foi cadastrada.',
            'data_fim.date' => 'O campo data de término deve ser uma data válida.',
            'data_fim.after' => 'A data de término deve ser igual ou posterior no mínimo 2 meses após a data de início.',
            'limite_orientacao.date' => 'O campo de data-limite para entrega da documentação de orientação deve ser uma data válida.',
            'limite_orientacao.before' => 'A data-limite para entrega da documentação de orientação deve ser uma data anterior à data de finalização do semestre.',
        ];
    }
}
