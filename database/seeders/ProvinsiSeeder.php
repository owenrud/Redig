<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\provinsi; 

class ProvinsiSeeder extends Seeder
{
    public function run()
    {
        $csvFile = storage_path('app/provinces.csv'); // Sesuaikan dengan lokasi file CSV Anda
        $csvData = array_map('str_getcsv', file($csvFile));

        foreach ($csvData as $row) {
            provinsi::create([
                'ID_provinsi' => $row[0],
                'nama' => $row[1], // Sesuaikan dengan struktur CSV Anda
            ]);
        }
    }
}
