<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('MRole')->insert([
            ['id' => 1, 'name' => 'Super Admin'],
            ['id' => 2, 'name' => 'Peserta'],
        ]);
    }
}
