<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Interfaces\RawDataInterface;

class DistrictSeeder extends Seeder
{
    protected $rawData;

    public function __construct(RawDataInterface $rawData)
    {
        $this->rawData = $rawData;
    }


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = $this->rawData->getDistricts();

        DB::table('MDistricts')->insert($districts);
    }
}
