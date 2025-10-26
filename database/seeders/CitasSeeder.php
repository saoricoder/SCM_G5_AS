<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\citas as Citas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     */
    public function run(): void
    {
        Citas::factory()->count(100)->create();
    }
}
