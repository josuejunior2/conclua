<?php

namespace App\Imports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use App\Models\Orientador;

class AdminsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $admin = Admin::updateOrCreate(
            ['nome'    => $row[0]],
            [
            'nome'     => $row[0],
            'email'    => $row[1],
            'password' => Hash::make('admin123'),
            ]
        );

        $orientador = Orientador::updateOrCreate(
            ['masp' => $row[2]], // Condições para procurar o orientador existente
            [
                'admin_id' => $admin->id,
                'masp' => $row[2],
            ]
        );

        return array($admin, $orientador);
    }
}
