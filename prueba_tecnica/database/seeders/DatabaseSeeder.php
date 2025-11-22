<?php

namespace Database\Seeders;

use App\Imports\CustomersImport;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $path = storage_path('app\public\customers.xlsx');
        if(file_exists($path)){
            FacadesExcel::import(new CustomersImport, $path);
            $this->command->info('Clientes importados correctamente.');
        }else{
            $this->command->error('el archivo customers.xlsx no se encuentra en: '. $path);
        }

    }
}
