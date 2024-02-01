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
        return new Academico([
            'name'     => $row[0],
            'email'    => $row[1],
            'password' => Hash::make('admin123'),
            'matricula'=> $row[2],
        ]);
    }
}
