<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\consultorios as Consultorios;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ConsultoriosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Consultorios::factory()->count(100)->create();
    }
}
