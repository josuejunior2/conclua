<?php

namespace App\Imports;

use App\Models\Orientador;
use App\Models\SemestreOrientador;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class OrientadoresImport implements ToModel
{
    protected $ativar;

    public function __construct(string $ativar = null){
        $this->ativar = $ativar;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $orientador = Orientador::updateOrCreate(
            ['masp' => $row[2]], // Condições para procurar o acadêmico existente
            [
                'nome' => $row[0],
                'email' => $row[1],
                'masp' => $row[2],
                'password' => Hash::make('admin123'),
            ]
        );

        if(app('semestreAtivo') && $this->ativar == "on"){
            SemestreOrientador::create([
                'semestre_id' => app('semestreAtivo')->id,
                'orientador_id' => $orientador->id,
            ]);
        }

        return $orientador;
    }
}
