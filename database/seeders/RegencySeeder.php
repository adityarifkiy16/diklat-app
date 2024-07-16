<?php

namespace Database\Seeders;

use App\Helper\RawDataGetter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get Data
        $regencies = RawDataGetter::getRegencies();


        // Insert Data to Database
        DB::table('MRegencies')->insert($regencies);
    }
}
