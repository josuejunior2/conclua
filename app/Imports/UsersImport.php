<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Academico;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class UsersImport implements ToModel, WithValidation, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        DB::transaction(function() use($row){       
            $user = User::updateOrCreate(
                ['nome'     => $row['nome']],
                [
                'nome'     => $row['nome'],
                'email'    => $row['email'],
                'password' => Hash::make($row['matricula']),
                ]
            );
            $academico = Academico::updateOrCreate(
                ['matricula'    => $row['matricula']], // Condições para procurar o acadêmico existente
                [
                    'user_id'   => $user->id,
                    'matricula' => $row['matricula'],
                ]
            ); 
            return array($user, $academico);
        });
    }
    
    public function rules(): array
    {
        return [
            'nome'  => 'required|string',
            'email' => 'required|email',
            'matricula'  => 'required|digits:9',
        ];
    }
    /**
     * Get the messages array.
     *
     */
    public function customValidationMessages(): array
    {
        return [
            'nome.required' => 'O campo nome deve ser preenchido.',
            'email.required' => 'O campo email deve ser preenchido.',
            'masp.required' => 'O campo masp deve ser preenchido.',
            'email.required' => 'O campo email deve ser preenchido.',
            'email.email' => 'O email do orientador deve ser um email válido.',
            'matricula.digits' => 'O MASP deve ter 9 dígitos numéricos.',
        ];
    }
}
