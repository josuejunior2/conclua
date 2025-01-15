<?php

namespace App\Imports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use App\Models\Orientador;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AdminsImport implements ToCollection, WithValidation, WithHeadingRow
{
   
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        // dd($rows);
        foreach ($rows as $row)
        {
            if($row->filter()->isNotEmpty()){
                DB::transaction(function() use($row){           
                    $admin = Admin::updateOrCreate(
                        ['nome'         => $row['nome']],
                        [
                            'nome'      => $row['nome'],
                            'email'     => $row['email'],
                            'password'  => Hash::make($row['masp']),
                        ]
                    );

                    $orientador = Orientador::updateOrCreate(
                        ['masp'         => $row['masp']], // Condições para procurar o orientador existente
                        [
                            'admin_id'  => $admin->id,
                            'masp'      => $row['masp'],
                        ]
                    );
                }); 
            }
        }
    }

    public function rules(): array
    {
        return [
            'nome'  => 'required|string',
            'email' => 'required|email',
            'masp'  => ['required', 'regex:/^\d{7,8}$|^\d{7}-\d$/', 'unique:orientadores,masp'],
        ];
    }
    /**
     * Get the messages array.
     *
     */
    public function customValidationMessages(): array
    {
        $orientadorExistente = Orientador::where('masp', request()->input('masp'))->exists() ? Orientador::where('masp', request()->input('masp'))->first()->User->nome : null;
        return [
            'nome.required' => 'O campo nome deve ser preenchido.',
            'email.required' => 'O campo email deve ser preenchido.',
            'masp.required' => 'O campo masp deve ser preenchido.',
            'email.email' => 'O email do orientador deve ser um email válido.',
            'masp.regex' => 'O MASP deve ter um destes formatos: 1234567, 12345678 ou 1234567-8.',
            'masp.unique' => 'O MASP já está cadastrado no orientador: ' . $orientadorExistente,
        ];
    }
}
