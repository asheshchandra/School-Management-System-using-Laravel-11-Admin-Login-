<?php

namespace Database\Seeders;
use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Dayseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Day::insert([
            ['name'=>'Saturday'],
            ['name'=>'Sunday'],
            ['name'=>'Monday'],
            ['name'=>'Tuesday'],
            ['name'=>'Wednesday'],
            ['name'=>'Thursday'],
            ['name'=>'Friday'],
        ]);
    }
}
