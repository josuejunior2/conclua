<?php

namespace App\Imports;

use App\Models\Academico;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class AcademicosImport implements ToModel
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
        $academico = Academico::updateOrCreate(
            ['matricula' => $row[2]], // Condições para procurar o acadêmico existente
            [
                'nome' => $row[0],
                'email' => $row[1],
                'matricula' => $row[2],
                'password' => Hash::make('admin123'),
            ]
        );

        return $academico;
    }
}
