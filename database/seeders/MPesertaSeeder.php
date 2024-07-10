<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MPesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate dummy data
        $data = [
            [
                'name' => 'John Doe',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-01',
                'alamat' => 'Jl. Merdeka No. 123',
                'nama_ibu' => 'Jane Doe',
                'nomer_telp' => '08123456789',
                'profesi' => 'Engineer',
                'gender' => 'Male',
                'user_id' => 4, // Replace with an existing user_id
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1995-05-15',
                'alamat' => 'Jl. Jenderal Sudirman No. 456',
                'nama_ibu' => 'Jessica Smith',
                'nomer_telp' => '0876543210',
                'profesi' => 'Doctor',
                'gender' => 'Female',
                'user_id' => 5, // Replace with an existing user_id
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more dummy data as needed
        ];

        // Insert data into database
        DB::table('MPeserta')->insert($data);
    }
}
