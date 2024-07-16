<?php

namespace Database\Seeders;

use App\Helper\RawDataGetter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = RawDataGetter::getDistricts();

        DB::table('MDistricts')->insert($districts);
    }
}
