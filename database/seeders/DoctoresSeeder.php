<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor; // <-- Importamos el modelo Doctor (PascalCase, singular)
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DoctoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usamos Doctor::factory() (PascalCase)
        Doctor::factory()->count(100)->create();
    }
}