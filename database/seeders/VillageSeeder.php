<?php

namespace Database\Seeders;

use App\Interfaces\RawDataInterface;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VillageSeeder extends Seeder
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
        $villages = $this->rawData->getVillages();

        // Insert Data with Chunk
        DB::transaction(function () use ($villages) {
            $collection = collect($villages);
            $parts = $collection->chunk(1000);
            foreach ($parts as $subset) {
                DB::table('MVillages')->insert($subset->toArray());
            }
        });
    }
}
