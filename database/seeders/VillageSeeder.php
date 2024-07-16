<?php

namespace Database\Seeders;

use App\Helper\RawDataGetter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get Data
        $villages = RawDataGetter::getVillages();

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
