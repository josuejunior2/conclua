<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Academico;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::updateOrCreate(
            ['nome'     => $row[0]],
            [
            'nome'     => $row[0],
            'email'    => $row[1],
            'password' => Hash::make('admin123'),
            ]
        );
        $academico = Academico::updateOrCreate(
            ['matricula'    => $row[2]], // Condições para procurar o acadêmico existente
            [
                'user_id'   => $user->id,
                'matricula' => $row[2],
            ]
        );
        return array($user, $academico);
    }
}
