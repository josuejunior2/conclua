<?php

namespace App\Imports;

use App\Models\Orientador;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class OrientadoresImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $orientador = Orientador::where('masp', $row[2])->first();

        if($orientador){
            $orientador->update([
                'nome'     => $row[0],
                'email'    => $row[1],
                'masp'     => $row[2],
                'status'   => 1 // ativou o cadastro NO semestre
            ]);
            return $orientador;
        }
        return new Orientador([
            'nome'     => $row[0],
            'email'    => $row[1],
            'password' => Hash::make('admin123'),
            'masp'     => $row[2],
            'status'   => 1 // ativou o cadastro NO semestre
        ]);
    }
}
