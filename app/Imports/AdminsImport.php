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

class AdminsImport implements ToCollection, WithValidation
{
   
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        // dd($rows);
        foreach ($rows as $row)
        {
            DB::transaction(function() use($row){
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
            }); 
        
        }
    }

    public function rules(): array
    {
        return [
            '0' => 'required|string',
            '1' => 'required|email',
            '2' => 'required|digits:7',
        ];
    }
}
