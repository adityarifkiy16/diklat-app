<?php

namespace Database\Seeders;

use App\Helper\RawDataGetter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get Data
        $provinces = RawDataGetter::getProvinces();

        DB::table('MProvinces')->insert($provinces);
    }
}
