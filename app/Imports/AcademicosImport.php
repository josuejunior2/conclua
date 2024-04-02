<?php

namespace App\Imports;

use App\Models\Academico;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class AcademicosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $academico = Academico::where('matricula', $row[2])->first();

        if($academico){
            $academico->update([
                'nome'     => $row[0],
                'email'    => $row[1],
                'matricula'=> $row[2],
                'status'   => 1 // ativou o cadastro NO semestre
            ]);
            return $academico;
        }
        return new Academico([
            'nome'     => $row[0],
            'email'    => $row[1],
            'password' => Hash::make('admin123'),
            'matricula'=> $row[2],
            'status'   => 1 // ativou o cadastro NO semestre
        ]);
    }
}
