<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Program::create([
            'title' => '1 Day Program',
            'description' => '1 Day Program Description',
            'numOfDays' => 1,
            'price' => 100.00,
        ]);

        Program::create([
            'title' => '1 Week Program',
            'description' => '1 Week Program Description',
            'numOfDays' => 7,
            'price' => 500.00,
        ]);

        Program::create([
            'title' => '1 Month Program',
            'description' => '1 Month Program Description',
            'numOfDays' => 30,
            'price' => 2500.00,
        ]);
    }
}
