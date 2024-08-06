<?php

namespace Database\Seeders;

use App\Interfaces\RawDataInterface;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
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
        // Get Data
        $provinces = $this->rawData->getProvinces();

        DB::table('MProvinces')->insert($provinces);
    }
}
