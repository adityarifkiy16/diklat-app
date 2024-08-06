<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Interfaces\RawDataInterface;

class RegencySeeder extends Seeder
{
    protected $rawData;

    // spesifik tipe param sesuai binding/singleton service provider
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
        $regencies = $this->rawData->getRegencies();


        // Insert Data to Database
        DB::table('MRegencies')->insert($regencies);
    }
}
