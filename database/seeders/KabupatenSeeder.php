<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\kabupaten;

class KabupatenSeeder extends Seeder
{
    public function run()
    {
        $csvFile = storage_path('app/regencies.csv'); // Sesuaikan dengan lokasi file CSV Anda
        $csvData = array_map('str_getcsv', file($csvFile));

        foreach ($csvData as $row) {
            kabupaten::create([
                'id'=>$row[0],
                'ID_provinsi' => $row[1],
                'nama' => $row[2], // Sesuaikan dengan struktur CSV Anda
            ]);
        }
    }
}
