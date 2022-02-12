<?php

namespace Database\Seeders;

use App\Models\Complaint;
use Illuminate\Database\Seeder;

class ComplaintsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Complaint::create([
            'title' => 'Denuncia ejemplo',
            'description' => 'Esto es la descripcion de esta denuncia'
        ]);
    }
}
