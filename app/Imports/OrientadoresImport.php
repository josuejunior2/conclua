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
        return new Orientador([
            'nome'     => $row[0],
            'email'    => $row[1],
            'password' => Hash::make('admin123'),
            'masp'     => $row[2],
        ]);
    }
}
